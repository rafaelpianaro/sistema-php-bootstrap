const tbody = document.querySelector(".list-users")
const addForm = document.getElementById("add-user-form")
const editForm = document.getElementById("edit-user-form")
const msgAlert = document.getElementById("msgAlert")
const msgAlertError = document.getElementById("msgAlertError")
const msgAlertErrorEdit = document.getElementById("msgAlertErrorEdit")
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
        const viewModal = new bootstrap.Modal(document.getElementById("viewUser"))
        viewModal.show()
        document.getElementById('idUser').innerHTML = response['dados'].id
        document.getElementById('nameUser').innerHTML = response['dados'].nome
        document.getElementById('mailUser').innerHTML = response['dados'].email
    }
}

async function editUser(id){
    msgAlertErrorEdit.innerHTML = ""
    const data = await fetch('viewUser.php?id='+id)
    const response = await data.json()
    // console.log('response', response)
    if(response['erro'])
        msgAlert.innerHTML = response['msg']
    else{
        const editModal = new bootstrap.Modal(document.getElementById("editUser"))
        editModal.show()
        document.getElementById('edit_id').value = response['dados'].id
        document.getElementById('edit_nome').value = response['dados'].nome
        document.getElementById('edit_email').value = response['dados'].email
    }   
}

editForm.addEventListener('submit',async(e) =>{
    e.preventDefault()
    // updating
    document.getElementById("edit-user-btn").value = "Atualizando..."
    const dataForm = new FormData(editForm)
    // show the values
    // for(var data of dataForm.entries()){
    //     console.log(data[0] + " - " + data[1])
    // }
    const data = await fetch("edit.php",{
        method: "POST",
        body: dataForm
    })
    const response = await data.json()
    // console.log('response', response)
    if(response['erro'])
        msgAlertErrorEdit.innerHTML = response['msg']
    else{
        msgAlertErrorEdit.innerHTML = response['msg']
        listUser(1)
    }
    document.getElementById("edit-user-btn").value = "Atualizar"
})

async function deleteUser(id){
    var msgConfirm = confirm("Atenção: realmente deseja deletar?")
    if(msgConfirm == true){
        const data = await fetch("delete.php?id="+id)
        const response = await data.json()
        if(response['erro'])
            msgAlert.innerHTML = response['msg']
        else{
            msgAlert.innerHTML = response['msg']
            listUser(1)
        }
    }
}