import workflow_menu from '../vue-workflow/workflow_menu';

function getIndex(element) {
  return element.name == 'Workflow';
}

let vue_guard_menu = 
{
  name: 'Guard',        
  icon: 'fa fa-angle-right',
  link: '/admin/workflow/guard',
};

//WorkflowMenu[WorkflowMenu.findIndex(getIndex)].childItem.push(vue_guard_menu);

workflow_menu.child.push(vue_guard_menu);

export default vue_guard_menu;