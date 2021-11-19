
const tbody = document.querySelector(".list-users")

const listUser = async (paginate) => {
    const data = await fetch("./list.php?paginate="+paginate)
    // console.log(data.text)
    const response = await data.text()
    tbody.innerHTML = response
}
listUser(1)