let catalog = document.querySelector('.catalog')
let body = document.querySelector('body')

function removeModal() {
  let modalWindow = document.querySelector('.catalog__modal')
  modalWindow.remove();
}

catalog.addEventListener('click', (e) => {
  let catalogItem = null;
  if (e.target.classList.contains('catalog__item')) {
    catalogItem = e.target
  } else if (e.target.tagName !== 'DIV') {
    catalogItem = e.target.parentElement
  }
  body.insertAdjacentHTML("beforeend", `
    <div class="catalog__modal">
      <div class="catalog__item">
        <img src=${catalogItem.dataset.imageSrc} alt=${catalogItem.dataset.goodName}>
        <span>${catalogItem.dataset.goodName}</span>
        <span>${catalogItem.dataset.goodDescription}</span>
        <span>${catalogItem.dataset.goodPrice}</span>
      </div>
      <button class="catalog__modal-close" onclick="removeModal()">X</button>
    </div>
  `)
})