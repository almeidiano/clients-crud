import {c, cs, getId} from './minSelector.js';

class Clients {
	async getAllClients() {
		let req = await fetch('api/clients/getAllClients.php');
		let res = await req.json();
		let result = res.result;

		result.forEach(client => {
			let tbody = document.querySelector("table tbody");
			tbody.innerHTML += `<tr><th class="clientId" scope="row">${client.client_id}</th><th class="groupId" scope="row">${client.client_group_id}</th><td class="clientName">${client.client_name}</td><th class="clientCPF" scope="row">${client.client_cpf}</th><td class="clientAction text-center" scope="row"><button type="button" class="btn btn-warning text-light"data-id="${client.client_id}"data-bs-toggle="modal" data-bs-target="#editClient" onclick="getClientData(this)"><i class="fa-solid fa-pen-to-square"></i></button> <button type="button" class="btn btn-danger" data-id="${client.client_id}" onclick="deleteClient(this)"><i class="fa-solid fa-trash"></i></button></td></tr>`;
		})
	}

	async addClient() {
		VMasker(document.querySelector(".clientCPF")).maskPattern("999.999.999-99");
		const formElem = getId("formElem");

		formElem.addEventListener("submit", async function(e) {
			const instanceModal = document.getElementById('addClient');
			const modal = bootstrap.Modal.getInstance(instanceModal); 
			modal.hide();
			e.preventDefault();

			const formData = new FormData(this);

			let req = await fetch("api/clients/addClient.php", {
				method: "POST",
				body: formData
			});

			let res = await req.json();

			if(res.result.status) {
				const clients = new Clients();
				let tbody = document.querySelector("table tbody");
				tbody.innerHTML = null;
				clients.getAllClients();
				Swal.fire({ 
					title: 'Sucesso!',
					text: 'Cliente adicionado com sucesso!',
					icon: 'success',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}else{
				Swal.fire({ 
					title: 'Ops!',
					text: 'Ocorreu um erro.',
					icon: 'error',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}
		});
	}

	async getClientData(client_id) {
		let clientId = client_id.getAttribute("data-id");

		let req = await fetch(`api/clients/getClientInfo.php?client_id=${clientId}`);
		let res = await req.json();

		c(".clientNameEdit").value = res.client_name;
		c(".clientCPFEdit").value = res.client_cpf;
		c(".client_id").value = res.client_id;
		let clientGroupEdit = cs(".clientGroupEdit");

		clientGroupEdit.forEach(option => {
			if(res.client_group_id == option.value){
				option.selected = true;
			}
		});
	}

	async updateClient() {
		VMasker(document.querySelector(".clientCPFEdit")).maskPattern("999.999.999-99");
		const formElemEdit = document.getElementById("formElemEdit");

		formElemEdit.addEventListener("submit", async function(e) {
			const instanceModal = document.getElementById('editClient');
			const modal = bootstrap.Modal.getInstance(instanceModal); 
			modal.hide();
			e.preventDefault();
			const data = { 
				client_name: e.target.elements[0].value,
				client_cpf: e.target.elements[1].value,
				client_group_id: e.target.elements[2].value,
				client_id: e.target.elements[3].value
			}

			let req = await fetch(`api/clients/updateClient.php`, {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data)
			});
			let res = await req.json();

			if(res.result.status) {
				const clients = new Clients();
				let tbody = document.querySelector("table tbody");
				tbody.innerHTML = null;
				clients.getAllClients();
				Swal.fire({ 
					title: 'Sucesso!',
					text: 'Cliente editado(a) com sucesso!',
					icon: 'success',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}else{
				Swal.fire({ 
					title: 'Ops!',
					text: 'Ocorreu um erro.',
					icon: 'error',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}
		});
	}

	async deleteClient(client_id) {
		let clientId = client_id.getAttribute("data-id");

		fetch(`api/clients/viewClientName.php?client_id=${clientId}`)
		.then((res) => {
			return res.json();
		}).then((name) => {
			Swal.fire({
				title: 'Você tem certeza?',
				text: `O(a) Cliente ${name} será deletado(a)!`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#6c757d',
				cancelButtonText: 'Cancelar',
				confirmButtonText: "Excluir"
			}).then(async(result) => {
				if(result.isConfirmed) {
					let delReq = await fetch(`api/clients/deleteClient.php?client_id=${clientId}`, {
						method: "DELETE"
					});
					let delRes = await delReq.json();

					if(delRes.result.status) {
						const clients = new Clients();
						let tbody = c("table tbody");
						tbody.innerHTML = null;
						clients.getAllClients();
						Swal.fire({ 
							title: 'Sucesso!',
							text: 'Cliente deletado(a) com sucesso!',
							icon: 'success',
							confirmButtonColor: '#0d6efd',
							confirmButtonText: 'Continuar'
						})
					}else{
						Swal.fire({ 
							title: 'Ops!',
							text: 'Ocorreu um erro ao deletar o cliente.',
							icon: 'error',
							confirmButtonColor: '#0d6efd',
							confirmButtonText: 'Continuar'
						})
					}
				}
			})
		}).catch((error) => 
		Swal.fire({ 
			title: 'Ops!',
			text: 'Ocorreu um erro.',
			icon: 'error',
			confirmButtonColor: '#0d6efd',
			confirmButtonText: 'Continuar'
		})
		);
	}
}

class Groups{
	async getAllGroups() {
		let req = await fetch('api/groups/getAllGroups.php');
		let res = await req.json();
		let result = res.result;

		result.forEach(group => {
			let tbody = c("table tbody");
			tbody.innerHTML += `<tr><th class="clientId" scope="row">${group.group_id}</th><th class="groupId" scope="row">${group.group_name}</th><th><button type="button" class="btn btn-warning text-light"data-id="${group.group_id}"data-bs-toggle="modal" data-bs-target="#editGroup" onclick="getGroupData(this)"><i class="fa-solid fa-pen-to-square"></i></button></th></tr>`;
		})
	}

	async addGroup() {
		const formElem = getId("formElem");

		formElem.addEventListener("submit", async function(e) {
			const instanceModal = getId('addGroup');
			const modal = bootstrap.Modal.getInstance(instanceModal); 
			modal.hide();
			e.preventDefault();

			const formData = new FormData(this);

			let req = await fetch("api/groups/addGroup.php", {
				method: "POST",
				body: formData
			});

			let res = await req.json();

			if(res.result.status) {
				const groups = new Groups();
				let tbody = c("table tbody");
				tbody.innerHTML = null;
				groups.getAllGroups();
				Swal.fire({ 
					title: 'Sucesso!',
					text: 'Grupo adicionado com sucesso!',
					icon: 'success',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}else{
				Swal.fire({ 
					title: 'Ops!',
					text: 'Ocorreu um erro.',
					icon: 'error',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}
		});
	}

	async getGroupData(group_id) {
		let groupId = group_id.getAttribute("data-id");

		let req = await fetch(`api/groups/getGroupInfo.php?group_id=${groupId}`);
		let res = await req.json();

		c(".groupNameEdit").value = res.group_name;
		c(".groupDescEdit").value = res.group_desc;
		c(".group_id").value = res.group_id;
	}

	async updateGroup() {
		const formElemEdit = getId("formElemEdit");

		formElemEdit.addEventListener("submit", async function(e) {
			const instanceModal = getId('editGroup');
			const modal = bootstrap.Modal.getInstance(instanceModal); 
			modal.hide();
			e.preventDefault();
			const data = { 
				group_name: e.target.elements[0].value,
				group_desc: e.target.elements[1].value,
				group_id: e.target.elements[2].value
			}

			let req = await fetch(`api/groups/updateGroup.php`, {
				method: 'PUT',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data)
			});
			let res = await req.json();

			if(res.result.status) {
				const groups = new Groups();
				let tbody = c("table tbody");
				tbody.innerHTML = null;
				groups.getAllGroups();
				Swal.fire({ 
					title: 'Sucesso!',
					text: 'Grupo editado com sucesso!',
					icon: 'success',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}else{
				Swal.fire({ 
					title: 'Ops!',
					text: 'Ocorreu um erro.',
					icon: 'error',
					confirmButtonColor: '#0d6efd',
					confirmButtonText: 'Continuar'
				})
			}
		});
	}

	async deleteGroup(group_id) {
		let groupId = group_id.getAttribute("data-id");

		fetch(`api/groups/viewGroupName.php?group_id=${groupId}`)
		.then((res) => {
			return res.json();
		}).then((name) => {
			Swal.fire({
				title: 'Você tem certeza?',
				text: `O Grupo ${name} será deletado, deixando todos os usuários inclusos sem um grupo definido!`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#6c757d',
				cancelButtonText: 'Cancelar',
				confirmButtonText: "Excluir"
			}).then(async(result) => {
				if(result.isConfirmed) {
					let delReq = await fetch(`api/groups/deleteGroup.php?group_id=${groupId}`, {
						method: "DELETE"
					});
					let delRes = await delReq.json();

					if(delRes.result.status) {
						const groups = new Groups();
						let tbody = c("table tbody");
						tbody.innerHTML = null;
						groups.getAllGroups();
						Swal.fire({ 
							title: 'Sucesso!',
							text: 'Grupo deletado com sucesso!',
							icon: 'success',
							confirmButtonColor: '#0d6efd',
							confirmButtonText: 'Continuar'
						})
					}else{
						Swal.fire({ 
							title: 'Ops!',
							text: 'Ocorreu um erro ao deletar o grupo.',
							icon: 'error',
							confirmButtonColor: '#0d6efd',
							confirmButtonText: 'Continuar'
						})
					}
				}
			})
		}).catch((error) => 
		Swal.fire({ 
			title: 'Ops!',
			text: 'Ocorreu um erro.',
			icon: 'error',
			confirmButtonColor: '#0d6efd',
			confirmButtonText: 'Continuar'
		})
		);
	}
}

export {Clients, Groups}