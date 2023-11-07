(function(){
   //console.log('Début du carrousel')
   let carrousel__ouvrir = document.querySelector('.carrousel__ouvrir')
   let carrousel = document.querySelector('.carrousel')
   //let carrousel__x = document.querySelector('.carrousel__x')
   let carrousel__figure = document.querySelector('.carrousel__figure')
   let carrousel__form = document.querySelector('.carrousel__form')
   let carrousel__gauche = document.querySelector('.carrousel__gauche')
   let carrousel__droite = document.querySelector('.carrousel__droite')
    let video_du_projet = document.querySelector('.video_projet')
   //console.log(carrousel__form.tagName) //conteneur de radio-boutons

   let galerie = document.querySelector('.galerie', )
   let galerie__img = galerie.querySelectorAll('img')

  /* PAS BESOIN D'UN POP POP
   galerie.addEventListener('mousedown', function(){
         carrousel.classList.add('carrousel--activer')
     })

   carrousel__x.addEventListener('mousedown', function(){
      carrousel.classList.remove('carrousel--activer')
   })*/

/**
 * Pour chaque image de la galerie l'ajouter dans le carrousel
 */
let position = 0
let index = 0
let ancienIndex = -1

   /*for (const elem of galerie__img){

      elem.dataset.index = position

      elem.addEventListener('mousedown',function(){
      index = this.dataset.index
      affiche_image_carrousel(index)
      console.log(index)
    })

      
   }*/
ajouter_une_image_dans_carrousel()
ajouter_des_boutons_dans_le_carrousel()
affiche_image_carrousel();

/**
 * Création dynamique d'une image pour le carrousel
 * @param {*} elem une image de la galerie
 */
function ajouter_une_image_dans_carrousel()
{
   //let video = document.createElement('.video_projet')
   video_du_projet.classList.add('carrousel__img')
   video_du_projet.src = elem.src
   // console.log(img.src)
   carrousel__figure.append(video_du_projet);
}

function ajouter_des_boutons_dans_le_carrousel(){
   //let bou = document.createElement('input')
   //bou.setAttribute('type', 'button')
   //bou.setAttribute('name', 'carrousel__bou')
   carrousel__gauche.addEventListener('mousedown', function(){
      //carrousel.classList.add('carrousel__moins')
      index = 3
      console.log(index)
  })
  carrousel__droite.addEventListener('mousedown', function(){
   carrousel.classList.add('carrousel__plus')

})
   /*bou.classList.add('carrousel__bou')
   bou.dataset.index = position
   bou.addEventListener('mousedown', function(){
      position = position + 1
      index = this.dataset.index
      affiche_image_carrousel();
   })*/
   position = position + 1 //incrémentation de la position
   //carrousel__form.appendChild(bou);
}

/**
 * Affiche la nouvelle image du carrouel
 */
function affiche_image_carrousel(){
   if(ancienIndex != -1){
      carrousel__figure.children[ancienIndex].style.opacity = "0"
      //carrousel__figure.children[ancienIndex].classList.remove('carrousel__img--activer');
   }
   //console.log(this.dataset.index)
   carrousel__figure.children[index].style.opacity = "1"
   //carrousel__figure.children[index].classList.add('carrousel__img--activer');
   ancienIndex = index
}


})