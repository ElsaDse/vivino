<div class="lobby-container" id="app">
  <div @click="cancelSearch" v-if="searchKey || countrySelected || grapesSelected" class="cancel">
    <h5>Annuler recherche</h5>
    <i class="fas fa-times"></i>
  </div>
  
  <ul>
    <li  @click="searchInput('name')" class="name">
      <i class="fas fa-search"></i>
      <input v-if="inputType == 'name'" v-model="searchKey" type="search" class="search" placeholder="Entrez le nom d'un vin...">
    </li>

    <li  @click="searchInput('country')" class="country">
      <i class="fas fa-globe-europe"></i>
      <select v-show="inputType == 'country'" v-model="countrySelected">
        <option value="">choissisez un pays</option>
        <option  v-for="option in countryOption" v-bind:value="option.id">{{option.name}}</option>
      </select>
    </li>

    <li  @click="searchInput('grapes')" class="grapes">
      <i class="fas fa-wine-glass-alt"></i>
      <div class="radio-container" v-if="inputType == 'grapes'">
        <div v-for="grape in grapesRadio" class="radio">
          <label :for="grape.name">{{grape.name}}</label>
          <input v-model="grapesSelected" :id="grape.name" :value="grape.name" type="radio" class="radio-button">
        </div> 
    </li>
  </ul>

  <h1 v-if="inputType == ''" class="title">Liste des vins</h1>
  <h3 v-if="search.length == 0">Aucun résultat</h3>

  <div class="list-container">
    <div v-for="wine, id in search" class="wine-list" v-bind:key="id" >
      <div class="wine-card">
        <div class="card-header">
          <h2> {{wine.name}}</h2>
          <i @click="removeItem(id)" class="fas fa-times"></i>
        </div>
        <div class="container">
          <div class="text-container">
            <div class="buttons">
              <h4>{{wine.year}}</h4>
              <h4>{{wine.country}}</h4>
              <h4>{{wine.grapes}}</h4>
            </div>
            <div class="location">
              <i class="fas fa-map-marker-alt"></i>
              <span> {{wine.region}}</span>
            </div>
            <p>{{wine.description}}</p>
          </div>
          <img :src="getImgUrl(wine.picture)" alt="photo-bouteille">
        </div>
      </div>
    </div>
  </div>

</div>