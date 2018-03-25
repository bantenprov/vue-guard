# vue-guard

[![Join the chat at https://gitter.im/vue-guard/Lobby](https://badges.gitter.im/vue-guard/Lobby.svg)](https://gitter.im/vue-guard/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bantenprov/vue-guard/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/vue-guard/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/bantenprov/vue-guard/badges/build.png?b=master)](https://scrutinizer-ci.com/g/bantenprov/vue-guard/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/bantenprov/vue-guard/v/stable)](https://packagist.org/packages/bantenprov/vue-guard)
[![Total Downloads](https://poser.pugx.org/bantenprov/vue-guard/downloads)](https://packagist.org/packages/bantenprov/vue-guard)
[![Latest Unstable Version](https://poser.pugx.org/bantenprov/vue-guard/v/unstable)](https://packagist.org/packages/bantenprov/vue-guard)
[![License](https://poser.pugx.org/bantenprov/vue-guard/license)](https://packagist.org/packages/bantenprov/vue-guard)
[![Monthly Downloads](https://poser.pugx.org/bantenprov/vue-guard/d/monthly)](https://packagist.org/packages/bantenprov/vue-guard)
[![Daily Downloads](https://poser.pugx.org/bantenprov/vue-guard/d/daily)](https://packagist.org/packages/bantenprov/vue-guard)

Manage laravel permission using vuejs

### Modul ini membutuhkan :

- <a href="https://github.com/bantenprov/vue-workflow">Vue Workflow</a>

- <a href="https://github.com/bantenprov/vue-trust">Vue Trust</a>

### Install via composer :

```bash
$ composer require bantenprov/vue-guard:dev-master
```

### edit config/app.php

```php

'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
	//=======

	Bantenprov\VueGuard\VueGuardServiceProvider::class,

```

### artisan command 

```bash
$ php artisan vendor:publish --tag=vue-guard-assets
$ php artisan migrate
```

### tambahkan pada resources/assets/js/routes/routes.js

```javascript
{
      path: '/admin',
      name: 'admin',
      redirect: '/admin/dashboard',
      component: layout('Default'),
      children: [
	//............
	//=== vue guard route
          {
          path: '/admin/workflow/guard',
          components: {
            main: resolve => require(['~/components/bantenprov/vue-guard/vue_guard.index.vue'], resolve),
            navbar: resolve => require(['~/components/Navbar.vue'], resolve),
            sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
          },
          meta: {
            title: "Guard"
              }
          },
          {
          path: '/admin/workflow/guard/:id/show',
          components: {
            main: resolve => require(['~/components/bantenprov/vue-guard/vue_guard.show.vue'], resolve),
            navbar: resolve => require(['~/components/Navbar.vue'], resolve),
            sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
          },
          meta: {
            title: "Guard"
              }
          },
          {
          path: '/admin/workflow/guard/create',
          components: {
            main: resolve => require(['~/components/bantenprov/vue-guard/vue_guard.create.vue'], resolve),
            navbar: resolve => require(['~/components/Navbar.vue'], resolve),
            sidebar: resolve => require(['~/components/Sidebar.vue'], resolve)
          },
          meta: {
            title: "Guard"
              }
          },
        //=== end guard route
```

### tambahkan pada resources/assets/js/app.js

```javascript
new Vue({
  store,
  router,
  template: '<App/>',
  components: { App }
}).$mount('#app')

//---------------------

//== vue guard menus
import vue_guard_menu from './components/bantenprov/vue-guard/vue_guard_menu';

```


### npm command : 
( development )

```bash

$ npm run dev

```

( production )

```bash
$ npm run prod
```
