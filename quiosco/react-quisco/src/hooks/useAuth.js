import clienteAxios from "../config/axios"
import useSWR from "swr"
import { useEffect } from "react"
import { useNavigate } from "react-router-dom"

export const useAuth = ({middleware, url}) => {

    const token = localStorage.getItem("AUTH_TOKEN")
    const navigate = useNavigate()

    const {data: user, error, mutate} = useSWR("/api/user", () => 
        clienteAxios("/api/user", {
            headers:{
                Authorization: `Bearer ${token}`
            }
        })
        .then(res => res.data)
        .catch(error => {
            throw Error(error?.response?.data?.errors)
        })
    )

    const login = async (datos, setErrores) => {
        try {
            const {data} = await clienteAxios.post("/api/login", datos)
            localStorage.setItem("AUTH_TOKEN", data.token)
            setErrores([])
            await mutate()
        } catch (e) {
            setErrores(Object.values(e.response.data.errors))
        }
    }

    const registro = async (datos, setErrores) => {
        try {
            const {data} = await clienteAxios.post("/api/registro", datos)
            localStorage.setItem("AUTH_TOKEN", data.token)
            setErrores([])
            await mutate()
        } catch (e) {
            setErrores(Object.values(e.response.data.errors))
        }
    }

    const logout = async () => {
        try {
            await clienteAxios.post("/api/logout", null, {
                headers:{
                    Authorization: `Bearer ${token}`
                }
            })
            localStorage.removeItem("AUTH_TOKEN")
            await mutate(undefined)
        } catch (e) {
            throw Error(error?.response?.data?.errors)
        }
    }
    
    console.log(user)

    useEffect(() => {
        if (middleware == "guest" && user && user.admin) {
            return navigate("/admin")
        }
        if (middleware == "guest" && user && url) {
            return navigate(url)
        }
        if (middleware == "admin" && user && !user.admin) {
            return navigate("/")
        }
        if (middleware == "auth" && error) {
            return navigate("/auth/login")
        }
    }, [user, error])

    return {
        login,
        registro,
        logout,
        error,
        user
    }
}