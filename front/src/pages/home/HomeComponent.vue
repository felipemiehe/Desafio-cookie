
<template>
  <DashBoard :objeto="objeto" nometabela="Pessoas" v-on:itemchanged="getUsers()" />
    
</template>

 <!-- _______________________SCRIPT__________________________ --> 
<script>

  import DashBoard from "../../components/DashBoard"; // importa ele
  import axios from 'axios';

  export default{
    // utiliza ele
    components:{ 
      DashBoard,
      
    },

    data() {
        return {            
          objeto: [],         
        }
    },

    mounted: function () {
        this.getUsers();
    },

    methods: {
    async getUsers()     {
      const res = await axios.get('/pessoas')      
      if (res.status == 200) {
          // console.log(res.data);
          this.objeto = res.data;
      } else{
          console.log('ERROR');
      }
}

},


};  
  
</script>

<!-- _______________________STYLE__________________________ -->
  
<style scoped>

</style>
  