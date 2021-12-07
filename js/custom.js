const tbody = document.querySelector(".list-users")
const addForm = document.getElementById("add-user-form")
const msgAlert = document.getElementById("msgAlert")
const msgAlertError = document.getElementById("msgAlertError")
const modal = new bootstrap.Modal(document.getElementById("addUser"))

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
    // saving
    document.getElementById("add-user-btn").value = "Salvando..."
    // console.log('dataForm', dataForm)
    const data = await fetch("save.php",{
        method: "POST",
        body: dataForm,
    })
    const response = await data.json();
    // console.log('response', response)
    if(response['erro']){
        msgAlertError.innerHTML = response['msg']
        // msgAlert.innerHTML = response['msg']
    }else{
        msgAlert.innerHTML = response['msg']
        addForm.reset()
        modal.hide()
        listUser(1)
    }
    setTimeout(function(){ msgAlert.innerHTML = ""; }, 3000);
    document.getElementById("add-user-btn").value = "Salvar"
})

async function viewUser(id){
    // console.log('clicou', id)
    const data = await fetch('viewUser.php?id='+id)
    const response = await data.json()
    // console.log('response', response)
    if(response['erro'])
        msgAlert.innerHTML = response['msg']
    else{
        const modal = new bootstrap.Modal(document.getElementById("viewUser"))
        modal.show()
        document.getElementById('idUser').innerHTML = response['dados'].id
        document.getElementById('nameUser').innerHTML = response['dados'].nome
        document.getElementById('mailUser').innerHTML = response['dados'].email
    }
    
}