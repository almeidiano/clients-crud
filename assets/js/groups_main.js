import * as api from './modules/api.js';
const groups = new api.Groups();

groups.getAllGroups();
groups.addGroup();
groups.updateGroup();

document.getGroupData = (group_id) => {
	groups.getGroupData(group_id);
}

document.deleteGroup = (group_id) => {
	groups.deleteGroup(group_id);
}
