

//Función que muestra el dropdown
const dropdownOptions = (btnClass,idList) => {
  document.getElementById("dropdown-list-"+ idList).classList.toggle("show");
  let dropdownbtn = document.getElementsByClassName(btnClass)[0];
  dropdownbtn.classList.add('active');
}
window.onclick = (e) => {
  const hasDropdownClass = e.target.className.includes('dropdownbtn');
  if (!hasDropdownClass) {
    let dropdowns = document.querySelectorAll("*[class^=dropdown-content");
    for (i = 0; i < dropdowns.length; i++) {
      let openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');

      }
    }
  }
}
