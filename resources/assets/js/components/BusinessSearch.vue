<template>
   <div class="input-group input-group-lg w-100">
      <input id="businessSearch" class="form-control search-query" type="search" autocomplete="off" v-model="business_search" placeholder="Поиск организации" aria-label="Поиск организации">
      <span class="input-group-append">
          <button class="btn btn-outline-default" type="button"><span class="fa fa-search"></span></button>
      </span>

      <ul id="businessSearchResults" v-cloak v-if="business_search_results" v-bind:style="{width: width+'px'}" class="inlineSearchWidget">
         <li v-for="(result,key) in business_search_results" :id="key + 1" v-bind:class="[(key + 1 == count) ? activeClass : '', menuItem]">
            <a class="text-truncate" v-bind:href="result.route">{{result.title}}</a>
            <span class="text-muted">{{result.subtitle}}</span>
         </li>
      </ul>
   </div>
</template>

<script>
   export default{
      name: 'business-search',
      data (){
         return {
            business_search: '',
            business_search_results: '',
            count: 0,
            width: 0,
            menuItem: 'menu-item px-2 d-flex flex-column',
            activeClass: 'active'
         };
      },

      methods: {
         getSearchB: _.debounce(function() {
             this.business_search_results = '';
             this.count = 0;
             self = this;

             if (this.business_search.trim() !== '') {
                 axios.get('/api/search',{
                     params:{
                        q : self.business_search
                     }
                 })
                .then(function (response) {
                   self.business_search_results = response.data;
                 })
                .catch(function (error) {
                     console.log(error);
                 });
             }

         }, 500),

         selectResultB: function(keyCode) {
             // If down arrow key is pressed
             if (keyCode == 40 && this.count < this.business_search_results.length) {
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

         clearDataB: function(e) {
             if (e.target.id != 'businessSearch') {
                 this.business_search_results = '';
                 this.count = 0;
             }
         }

      },

      mounted: function() {
         self = this;
         // get width of search input for vue search widget on initial load
         this.width = document.getElementById("businessSearch").offsetWidth;
         // get width of search input for vue search widget when page resize
         window.addEventListener('resize', function(event){
             self.width = document.getElementById('businessSearch').offsetWidth;
         });

         // To clear vue search widget when click on body
         document.body.addEventListener('click',function (e) {
            self.clearDataB(e);
         });

         document.getElementById('businessSearch').addEventListener('keydown', function(e) {
             // check whether arrow keys are pressed
             if(_.includes([37, 38, 39, 40, 13], e.keyCode) ) {
                 if (e.keyCode === 38 || e.keyCode === 40) {
                     // To prevent cursor from moving left or right in text input
                     e.preventDefault();
                 }

                 if (e.keyCode === 40 && self.business_search_results === "") {
                     // If post list is cleared and search input is not empty
                     // then call ajax again on down arrow key press
                     self.getSearchB();
                     return;
                 }

                 self.selectResultB(e.keyCode);

             } else {
                 self.getSearchB();
             }
         });
      }
   }
</script>