<template>
   <div class="nav-search w-50">
      <input id="headerSearch" class="form-control search-query" type="search" autocomplete="off" v-model="header_search" placeholder="Поиск" aria-label="Поиск">
   
      <ul v-cloak v-if="search_results" v-bind:style="{width: width+'px'}" class="inlineSearchWidget">
         <li v-for="(result,key) in search_results" :id="key + 1" v-bind:class="[(key + 1 == count) ? activeClass : '', menuItem]">
            <a class="text-truncate" v-bind:href="result.route">{{result.title}}</a>
            <span class="text-muted">{{result.subtitle}}</span>
         </li>
      </ul>
   </div>
</template>

<script>
   export default{
      data: function(){
         return {
            header_search: '',
            search_results: '',
            count: 0,
            width: 0,
            menuItem: 'menu-item px-2 d-flex flex-column',
            activeClass: 'active'
         };
      },
      
      methods: {
         getSearch: _.debounce(function() {
             this.search_results = '';
             this.count = 0;
             self = this;

             if (this.header_search.trim() != '') {
                 axios.get('/api/search',{
                     params:{
                        q : self.header_search
                     }
                 })
                .then(function (response) {
                   self.search_results = response.data;
                 })
                .catch(function (error) {
                     console.log(error);
                 });  
             }

         }, 500),

         selectResult: function(keyCode) {
             // If down arrow key is pressed
             if (keyCode == 40 && this.count < this.search_results.length) {
                 this.count++;
             }
             // If up arrow key is pressed
             if (keyCode == 38 && this.count > 1) {
                 this.count--;
             }
             // If enter key is pressed
             if (keyCode == 13) {
                 // Go to selected post
                 document.getElementById(this.count).childNodes[0].click();
             }
         },
         
         clearData: function(e) {
             if (e.target.id != 'headerSearch') {
                 this.search_results = '',
                 this.count = 0;
             }
         }
         
      },
      
      mounted: function() {
         self = this;
         // get width of search input for vue search widget on initial load
         this.width = document.getElementById("headerSearch").offsetWidth;
         // get width of search input for vue search widget when page resize
         window.addEventListener('resize', function(event){
             self.width = document.getElementById('headerSearch').offsetWidth;
         });
         
         // To clear vue search widget when click on body
         document.body.addEventListener('click',function (e) {
            self.clearData(e);
         });
         
         document.getElementById('headerSearch').addEventListener('keydown', function(e) {
             // check whether arrow keys are pressed
             if(_.includes([37, 38, 39, 40, 13], e.keyCode) ) {
                 if (e.keyCode === 38 || e.keyCode === 40) {
                     // To prevent cursor from moving left or right in text input
                     e.preventDefault();
                 }

                 if (e.keyCode === 40 && self.search_results === "") {
                     // If post list is cleared and search input is not empty 
                     // then call ajax again on down arrow key press 
                     self.getSearch();
                     return;
                 }
                     
                 self.selectResult(e.keyCode);

             } else {
                 self.getSearch();
             }
         });         
      }
   }
</script>