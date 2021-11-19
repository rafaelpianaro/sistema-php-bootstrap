const tbody = document.querySelector(".list-users")
const addForm = document.getElementById("add-user-form")
const msgAlert = document.getElementById("msgAlert")

const listUser = async (paginate) => {
    const data = await fetch("./list.php?paginate="+paginate)
    // console.log(data.text)
    const response = await data.text()
    tbody.innerHTML = response
}
listUser(1)

addForm.addEventListener("submit", async (e) => {
    e.preventDefault()
    const dataForm = new FormData(addForm)
    dataForm.append("add",1)
    // console.log('dataForm', dataForm)
    const data = await fetch("save.php",{
        method: "POST",
        body: dataForm,
    })
    const response = await data.json();
    // console.log('response', response)
    if(response['erro']){
        msgAlert.innerHTML = response['msg']
    }else{
        msgAlert.innerHTML = response['msg']
    }
})