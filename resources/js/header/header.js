

let dropdownbtn = document.getElementsByClassName("dropdownbtn")[0];

//Función que muestra el dropdown
const showUserOptions = () => {
  document.getElementById("dropdown-list").classList.toggle("show");
  dropdownbtn.classList.add('active');
}
window.onclick = (e) => {
  if (!e.target.matches('.dropdownbtn')) {
    let dropdowns = document.getElementsByClassName("dropdown-content");
    let i;
    for (i = 0; i < dropdowns.length; i++) {
      let openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
        dropdownbtn.classList.remove('active');

      }
    }
  }
}
