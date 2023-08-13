import { createContext, useEffect, useState } from "react"
import { categorias as categoriasDb} from "../data/categorias"
import { toast } from "react-toastify"
import clienteAxios from "../config/axios"

const QuioscoContext = createContext()

const QuioscoProvider = ({children}) => {

   const [categorias, setCategorias] = useState([])
   const [categoriaActual, setCategoriaActual] = useState({})
   const [modal, setModal] = useState(false)
   const [producto, setProducto] = useState({})
   const [pedido, setPedido] = useState([])
   const [total, setTotal] = useState(0)

    useEffect(() => {
        const nuevoTotal = pedido.reduce((total, producto) => (producto.precio * producto.cantidad) + total, 0)
        setTotal(nuevoTotal)
    }, [pedido])
    
    const obtenerCategorias = async () => {
        try{
            const {data} = await clienteAxios.get("/api/categorias")
            setCategorias(data.data)
            setCategoriaActual(data.data[0])
        }catch(e){
            console.log(e)
        }
    }

    useEffect(() => {
        obtenerCategorias()
    }, [])

    const handleClickCategoria = id => {
        const categoria = categorias.filter(c => c.id == id)
        
        setCategoriaActual(categoria[0])
    }

    const handleClickModal = () => {
        setModal(!modal)
    }

    const handleSetProducto = producto => {
        setProducto(producto)
    }

    const hanldeAgregarPedido = ({categoria_id, ...producto}) => {
        if (pedido.some(pedidoState => pedidoState.id == producto.id)) {
            const pedidoActualizado = pedido.map(p => p.id == producto.id ? producto : p)
            
            setPedido(pedidoActualizado)
            toast.success("Guardado correctamente")
        }else{
           setPedido([...pedido, producto])
           toast.success("Agregado al pedido")
        }
    }

    const handleEditarCantidad = id => {
        const productoActulizar = pedido.filter(p => p.id == id)
        setProducto(productoActulizar[0])
        setModal(!modal);
    }

    const handleEliminarProductoPedido = id => {
        const pedidoActualizado = pedido.filter(p => p.id != id)
        setPedido(pedidoActualizado)
        toast.success("Eliminado del pedido")
    }

    const handleSubmitNuevaOrder = async () => {
        const token = localStorage.getItem("AUTH_TOKEN")

        try {
            const {data} = await clienteAxios.post("/api/pedidos", {
                total,
                productos: pedido.map(p => {
                    return {
                        id: p.id,
                        cantidad: p.cantidad
                    }
                })
            }, {
                headers:{
                    Authorization: `Bearer ${token}`
                }
            })
            toast.success(data.message)
            setTimeout(() => {
                setPedido([])
            }, 1000)
        } catch (e) {
            console.log(e)
        }
    }

    const handleClickCompletarPedido = async id => {
        try {
            const token = localStorage.getItem("AUTH_TOKEN")
            await clienteAxios.put(`/api/pedidos/${id}`, null, {
                headers:{
                    Authorization: `Bearer ${token}`
                }
            })
            
        } catch (e) {
            console.log(e)
        }
    }

    const handleClickProductoAgotado = async id => {
        try {
            const token = localStorage.getItem("AUTH_TOKEN")
            await clienteAxios.put(`/api/productos/${id}`, null, {
                headers:{
                    Authorization: `Bearer ${token}`
                }
            })
            
        } catch (e) {
            console.log(e)
        }
    }

  return (
    <QuioscoContext.Provider
        value={{
            categorias,
            categoriaActual,
            handleClickCategoria,
            modal,
            handleClickModal,
            handleSetProducto,
            producto,
            pedido,
            hanldeAgregarPedido,
            handleEditarCantidad,
            handleEliminarProductoPedido,
            total,
            handleSubmitNuevaOrder,
            handleClickCompletarPedido,
            handleClickProductoAgotado
        }}
    >
        {children}
    </QuioscoContext.Provider>
  )
}

export {
    QuioscoProvider
}

export default QuioscoContext