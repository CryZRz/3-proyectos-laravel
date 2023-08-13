import Dropzone from "dropzone"

Dropzone.autoDiscover = false

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aqui tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    init: function() {
       const getValue = document.querySelector("[name='imagen']").value.trim()
       
       if (getValue) {
        console.log("hola")
        const imagenPublicada = {}
        imagenPublicada.size = 1234 
        imagenPublicada.name = getValue

        this.options.addedfile.call(this, imagenPublicada)
        this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

        imagenPublicada.previewElement.classList.add("dz-success", "dz-complete")
       }
    }
})

dropzone.on("success", (file, response) => {
    document.querySelector("[name='imagen']").value = response.imagen
})

dropzone.on("removedfile", () => {
    document.querySelector("[name='imagen']").value = ""
})
