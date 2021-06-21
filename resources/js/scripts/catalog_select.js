let btns = document.querySelectorAll('.catalog-select');
console.log(bts);
btns.forEach((btn) => {
  btn.addEventListener('click', (event) => {
    let catalog_id = btn.getAttribute('data-catalog');
    console.log(catalog_id);
  });

});
