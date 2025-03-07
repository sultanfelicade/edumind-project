// edit data
function save(event) {
  event.preventDefault();
  saveConfirm();
  
}
function saveConfirm() {
  Swal.fire({
    title: "Apakah anda yakin ingin mengubah data ini??",
    showDenyButton: true,

    confirmButtonText: "Edit",
    denyButtonText: `Batal`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      Swal.fire({
        position: "top-center",
        icon: "success",
        title: "Your work has been saved",
        showConfirmButton: false,
        timer: 1500
      }).then(()=>{
        document.querySelector('form').submit();
      })
    } else if (result.isDenied) {
      Swal.fire("Perubahan Tidak Tersimpan", "", "info");
    }
  });
}

// hapus data
function deleteData(event) {
  event.preventDefault();
  deleteConfirm(event.target);
}
function deleteConfirm(button) {
  Swal.fire({
    title: "Apakah anda yakin ingin menghapus?",
    text: "Data Akan Hilang Permanen setelah anda menghapusnya",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#cccc00",
    confirmButtonText: "Hapus",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Deleted!",
        text: "Data Berhasil Dihapus.",
        icon: "success"
      }).then(()=>{
        button.closest('a').href && setTimeout(() => {
          window.location.href = button.closest('a').href;
        }, 100); //delay 100ms
        
      })
    }
  });
}
// Done
function doneData(event) {
  event.preventDefault();
  doneConfirm(event.target);
}
function doneConfirm(button) {
  Swal.fire({
    title: "Apakah anda yakin ingin menyelesaikan tugas ini?",
    text: "Data Akan Hilang Permanen setelah anda menyelesaikannya",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#cccc00",
    confirmButtonText: "Selesai",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Great Job!",
        text: "Anda Telah menyelesaikan tugas ini dengan baik.",
        icon: "success"
      }).then(()=>{
        button.closest('a').href && setTimeout(() => {
          window.location.href = button.closest('a').href;
        }, 100); //delay 100ms
        
      })
    }
  });
}

// logout
function logout(event) {
  event.preventDefault();
  logoutConfirm(event.target);
}
function logoutConfirm(button) {
  Swal.fire({
    title: "Apakah anda yakin ingin keluar?",
    icon: "question",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#cccc00",
    confirmButtonText: "keluar",
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        position: "top-center",
        title: "Anda Berhasil Keluar!",
        showConfirmButton: false,
        timer: 1500
      }).then(()=>{
        button.closest('a').href && setTimeout(() => {
          window.location.href = button.closest('a').href;
        }, 100);
        
      })
    }
  });
}

// detail dumb 
function detail(event) {
  event.preventDefault();
  detailConfirm(event.target);
}
function detailConfirm(button) {
  Swal.fire({
    title: "Detail Data",
    icon: "info",
    html: button.closest('td').innerHTML
  })
}
