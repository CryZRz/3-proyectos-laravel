import Categoria from "./Categoria"
import useQuiosco from "../hooks/useQuiosco"
import { useAuth } from "../hooks/useAuth"

export default function Sidebar() {

  const {categorias} = useQuiosco()
  const {logout, user} = useAuth({
    middleware: "auth"
  })

  return (
    <aside className="md:w-72">
        <div className="p-4">
            <img 
                src="img/logo.svg" 
                alt="imagen logo" 
                className="w-40"
            />
        </div>
        <p className="my-10 text-xl text-center font-bold">Hola: {user?.name}</p>
        <div className="mt-10">
            {
            categorias.map(c => (
                <Categoria
                    key={c.id}
                    categoria={c}
                />
            ))
            }
        </div>
        <div className="my-5 px-5">
        <button 
          onClick={logout}
          className="text-center bg-red-500 w-full p-3 font-bold 
          text-white truncate">
            Cancelar orden
        </button>
      </div>
    </aside>
  )
}
