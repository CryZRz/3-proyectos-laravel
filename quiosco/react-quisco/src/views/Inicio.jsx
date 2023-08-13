import Producto from "../components/Producto"
import useSWR from "swr"
import useQuiosco from "../hooks/useQuiosco"
import clienteAxios from "../config/axios"

export default function Inicio() {

  const token = localStorage.getItem("AUTH_TOKEN")
  const {categoriaActual} = useQuiosco()

  //consulta swr
  const fetcher = () => clienteAxios("/api/productos", {
    headers:{
        Authorization: `Bearer ${token}`
    }
  }).then(data => data.data)

  const {data, error, isLoading} = useSWR("/api/productos", fetcher, {
    refreshInterval: 8000
  })

  if(isLoading) return "Cargando..."

  const productos = data.data.filter(p => p.categoria_id == categoriaActual.id)

  return (
    <>
      <h1 className="text-4xl font-black">{categoriaActual.nombre}</h1>
      <p className="text-2xl my-10">Eligue y personaliza tu pedido</p>

      <div className="grid gap-4 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
        {
          productos.map(p => (
            <Producto
              key={p.imagen}
              producto={p}
              botonAgregar={true}
            />
          ))
        }
      </div>
    </>
  )
}
