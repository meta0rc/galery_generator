const modalGaleria = document.getElementById('modal-galeria')
const photoGaleria = document.getElementById('modal-photo')
const closeModalGaleria = document.getElementById('closeModal')
const photosGaleria = document.querySelectorAll('.thumb-galeria')

photosGaleria.forEach((p, i) => {
    const src = p.getAttribute("src")

    p.onclick = () => { 
        modalGaleria.classList.remove("hide")
        photoGaleria.setAttribute("src", src)
    }
})
closeModalGaleria.addEventListener('click', () => {
    modalGaleria.classList.add("hide")
})w