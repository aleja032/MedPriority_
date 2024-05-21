
    // --------------------------------------------CREATE MEDIC----------------------------------------------------------

  var guardarButton = document.getElementById("guardar-button");
  
  guardarButton.addEventListener("click", function() {
      console.log("i love everything you do.");
      var idNumber = document.querySelector('input[name="doc_id-number"]').value;
      var name = document.querySelector('input[name="doc_name"]').value;
      var age = document.querySelector('input[name="doc_age"]').value;
      var phoneNumber = document.querySelector('input[name="doc_phone-number"]').value;
      var email = document.querySelector('input[name="doc_email"]').value;
      var sex = document.querySelector('input[name="doc_sex"]').value;
      
      var datos = {
          idNumber: idNumber,
          name: name,
          age: age,
          phoneNumber: phoneNumber,
          email: email,
          sex: sex
      };
      
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "new_medic.php", true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText);
              console.log(datos);
          }
      };
      xhr.send(JSON.stringify(datos));
  });

    // ------------------------------------------ CREATE PATIENT----------------------------------------------

  var valo = document.getElementById("paciente-nuevo");
  
  valo.addEventListener("click", function() {
      
      console.log("when u call me fucking dumb for the stupid shit i do.");
      var pat_docType = document.querySelector('select[name="pat-id-type"]').value;
      var pat_idNumber = document.querySelector('input[name="pat_id-number"]').value;
      var pat_name = document.querySelector('input[name="pat_name"]').value;
      var pat_age = document.querySelector('input[name="pat_age"]').value;
      var pat_phoneNumber = document.querySelector('input[name="pat_phone-number"]').value;
      var pat_email = document.querySelector('input[name="pat_email"]').value;
      var pat_sex = document.querySelector('input[name="pat_sex"]').value;
      var pat_afiliation = document.querySelector('select[name="pat-afi"]').value;
     
      
      
      var daticos = {
          pat_idNumber: pat_idNumber,
          pat_name: pat_name,
          pat_age: pat_age,
          pat_phoneNumber: pat_phoneNumber,
          pat_email: pat_email,
          pat_sex: pat_sex,
          pat_docType: pat_docType,
          pat_afiliation: pat_afiliation
      };
      
      
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "new_patient.php", true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText);
              console.log(daticos);
          }
      };
      xhr.send(JSON.stringify(daticos));
  });

  // ----------------------------------------------DELETE---------------------------------

  var deleteButtons = document.querySelectorAll('.delete');

  deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
          var userId = this.dataset.userId;
          var userRole = button.getAttribute('data-role');

          console.log("chaooo "+ userId);

          console.log("holaaaa "+ userRole);
          // Send AJAX request to delete_user.php

          var chao = {
            userId : userId,
            userRole: userRole
          }
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'delete.php', true);
          xhr.setRequestHeader('Content-Type', 'application/json');

          xhr.onload = function() {
              if (xhr.status === 200) {
                  // Delete the table row from the DOM
                  console.log(xhr.responseText);
                  var tableRow = document.getElementById('table_row_' + userId);
                  if (tableRow) {
                      tableRow.remove();
                  }
              } else {
                  console.error('Error deleting user:', xhr.statusText);
              }
          };

          xhr.onerror = function() {
              console.error('AJAX request failed');
          };

          xhr.send(JSON.stringify(chao));
      });
  });

  // --------------------------------------- MODAL ------------------------------

  var openModalButton  = document.querySelectorAll('[data-modal-target]')
  var closeModalButton  = document.querySelectorAll('[data-close-button]')
  var overlay = document.getElementById('overlay')

  openModalButton.forEach(button => {
    button.addEventListener('click', () => {
      var modal = document.querySelector(button.dataset.modalTarget)
      openModal(modal)
      console.log("uwuwuwu");
    })
  })

  // overlay.addEventListener('click', () => {
  //   var modals = document.querySelectorAll('.modal.active')
  //   modals.forEach(modal => {
  //     closeModal(modal)
  //   })
  // })

  // ↑↑↑↑↑↑↑↑↑↑
  // when click on overlay (background) it closes the modal

  closeModalButton.forEach(button => {
    button.addEventListener('click', () => {
      var modal = button.closest('.modal')
      closeModal(modal)
    })
  })

  function openModal(modal) {
    modal.classList.add('active')
    overlay.classList.add('active')
  }

  function closeModal(modal) {
    modal.classList.remove('active')
    overlay.classList.remove('active')
               $.ajax({
                url: "modificar.php",
                type: "POST",
                data: $("#none").serialize(),
                success: function (respo) {
                  $('#contain_tablas').html(respo);
                   
                }
            });

  }

// -----------------------UPDATE USERS WHEN CLICK ON BUTTON-------------------------

// Iterate over all buttons with id starting with "sage"

var valorant = document.querySelectorAll('.save-button');
  // ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑

// Attach click event listener to each button
valorant.forEach(button => {
    button.addEventListener("click", function(){
        // Get the modal id associated with this button
        console.log("save-button");
        var modalId = this.getAttribute('data-modal-id');
        
        // Find all input fields within the modal
        var modal = document.getElementById(modalId);
        var inputs = modal.querySelectorAll('input');

        // Prepare data object to send via AJAX
        var data = {};
        inputs.forEach(input => {
            data[input.name] = input.value;
        });

        // Send AJAX request to update user data
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update.php", true);
        console.log(data);
        alert('Data Updated');
        xhr.send(JSON.stringify(data));
    });
});