
function showNotification(type, message) {
    let title, icon;

    if (type === 'success') {
        title = 'Sukses';
        icon = 'success';
    } else if (type === 'error') {
        title = 'Oops...';
        icon = 'error';
    }

    Swal.fire({
        icon: icon,
        title: title,
        text: message
    });
}


function confirmDelete(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Anda yakin ingin menghapus data ini?',
        text: "Tindakan ini tidak dapat dibatalkan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.closest('form').submit(); // Submit form jika pengguna mengonfirmasi
        }
    });
}

