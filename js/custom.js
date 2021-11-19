
const tbody = document.querySelector("tbody")

const listUser = async () => {
    const data = await fetch("./list.php")
    console.log(data.text)
    const response = await data.text()
    tbody.innerHTML = response
}
listUser()