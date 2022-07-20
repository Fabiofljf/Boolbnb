

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 /* window.Vue = require('vue'); */
 
 import tt from '@tomtom-international/web-sdk-maps';
 
 const map = tt.map({
     key: 'wwBjO0iyrGBDWYAR81J5EY7D4Y0HJGQj',
     container: 'map'
 });
 
 /* Search bar */
 import { services } from '@tomtom-international/web-sdk-services';
 import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';
 
 const options = {
     idleTimePress: 100,
     minNumberOfCharacters: 0,
     searchOptions: {
         key: 'wwBjO0iyrGBDWYAR81J5EY7D4Y0HJGQj',
         language: 'it-IT',
         extendedPostalCodesFor: 'Str',
         limit: 1,      
         countrySet: 'IT'
         //bestResult: true,
         
     },
     autocompleteOptions: {
         key: 'wwBjO0iyrGBDWYAR81J5EY7D4Y0HJGQj',
         language: 'it-IT',
     },
     noResultsMessage: 'No results found.'
 };
 
 
 const ttSearchBox = new SearchBox(services, options);
 //Attach searchboxHTML to your page
 
 var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
 document.getElementById('search-box').appendChild(searchBoxHTML);
 
 ttSearchBox.on('tomtom.searchbox.resultsfound', function(data) {
 
    console.log(data);
 
 let lat = data.data.results.fuzzySearch.results[0].position.lat;
 let lon = data.data.results.fuzzySearch.results[0].position.lng;
 
 let address = data.data.results.fuzzySearch.results[0].address.freeformAddress;
 

 
 document.getElementById('lat').value = lat ;
 document.getElementById('lon').value = lon ;
 document.getElementById('address').value = address ;
 });
 
 /** 
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 
 /* Vue.component('example-component', require('./components/ExampleComponent.vue').default); */
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 /* const app = new Vue({
     el: '#app',
 });  */