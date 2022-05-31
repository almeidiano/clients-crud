import * as api from './modules/api.js';
const clients = new api.Clients();

clients.getAllClients();
clients.addClient();
clients.updateClient();

document.getClientData = (client_id) => {
	clients.getClientData(client_id);
}

document.deleteClient = (client_id) => {
	clients.deleteClient(client_id);
}