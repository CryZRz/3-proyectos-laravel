import useQuiosco from "../hooks/useQuiosco"

export default function Categoria({categoria}) {

  const {icono, id, nombre} = categoria
  const {handleClickCategoria, categoriaActual} = useQuiosco()

  return (
    <div className={`flex items-cener gap-4 border w-full p-3 hover:bg-amber-400 cursor-pointer ${categoriaActual.id == id ? "bg-amber-400" : "bg-white"}`}>
      <img 
        className="w-12" 
        src={`/img/icono_${icono}.svg`} 
        alt={`imagen icono ${icono}`} 
      />
      <button 
        className="text-lg font-bold cursor-pointer truncate"
        type="button"
        onClick={e => {handleClickCategoria(id)}}
      >
        {nombre}
      </button>
    </div>
  )
}
