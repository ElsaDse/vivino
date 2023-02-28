 vue= new Vue({
    data: () => {
        return{
          wines: [],
          searchKey:"",
          inputType: "",
          countryList: [],
          countryOption: [],
          countrySelected: "",
          grapesRadio: [
            { name: "Pinot Noir" },
            { name: "Sauvignon" },
            { name: "Merlot" },
            { name: "Chardonnay" },
          ],
          grapesSelected: "",
        }
    },
    computed:{
        search() {
            return this.wines.filter((wine) => {
              return (
                wine.name.toLowerCase().includes(this.searchKey.toLowerCase()) &&
                wine.country.toLowerCase().includes(this.countrySelected.toLowerCase()) &&
                wine.grapes.toLowerCase().includes(this.grapesSelected.toLowerCase())
              );
            });
          },
    },
    methods:{
        removeItem(id){
            this.$delete(this.wines, id);
        },
        getImgUrl(picture) {
            return "assets/uploads/" + picture;
        },
        searchInput(param){
            this.inputType= param;
        },
        cancelSearch() {
            this.searchKey = "";
            this.countrySelected = "";
            this.grapesSelected = "";
        },
    },
    mounted(){
        axios
        .get("http://localhost/vuejs-php/libraries/controllers/getData.php")
        .then((res) => this.wines=res.data)
        .then(() => {
            for (let i = 0; i <= this.wines.length; i++) {
              if (!this.countryList.includes(this.wines[i].country)) {
                this.countryList.push(this.wines[i].country);
              }
            }
        });
        setTimeout(() => {
            let arr = this.countryList.sort();
            for (let i = 0; i < arr.length; i++) {
              this.countryOption.push({
                name: arr[i],
                id: arr[i],
              });
            }
          }, 500);


    }
}).$mount("#app");