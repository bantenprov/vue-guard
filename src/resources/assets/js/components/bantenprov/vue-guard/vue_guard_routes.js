import routes from '../../../router/routes';

function layout(name) {
	return function(resolve) {
		require(['../../../layouts/' + name + '.vue'], resolve);
	}
}

function getIndex(element) {
	return element.path == '/admin';
}

let vue_guard_routes = [
	{
		path: '/admin/workflow/guard',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-guard/vue_guard.index.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Guard"
        }
    },
    {
		path: '/admin/workflow/guard/:id/show',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-guard/vue_guard.show.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Guard"
        }
    },
    {
		path: '/admin/workflow/guard/create',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-guard/vue_guard.create.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Guard"
        }
    },
    {
		path: '/admin/workflow/guard/:id/edit',
		components: {
			main: resolve => require(['../../../components/bantenprov/vue-guard/vue_guard.edit.vue'], resolve),
			navbar: resolve => require(['../../../components/Navbar.vue'], resolve),
			sidebar: resolve => require(['../../../components/Sidebar.vue'], resolve)
		},
		meta: {
			title: "Guard"
        }
    }

];

vue_guard_routes.forEach((route,index)=>{
	routes[routes.findIndex(getIndex)].children.push(route);
});

export default vue_guard_routes;
