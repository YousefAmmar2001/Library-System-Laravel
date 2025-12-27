function confirmDestroy(url, id, reference) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            deleteItem(url, id, reference);
        }
    });
}

function deleteItem(url, id, reference) {
    axios.delete(url + '/' + id)
        .then(function (response) {
            showMessage(response.data);
            reference.closest('tr').remove();
        })
        .catch(function (error) {
            showMessage(error.response.data);
        });
}

function showMessage(data) {
    Swal.fire({
        icon: data.icon,
        title: data.title,
        showConfirmButton: false,
        timer: 1500
    });
}

function createItem(url, data) {
    axios.post(url, data).then(function (response) {
        toastr.success(response.data.message)
        document.getElementById('create-form').reset();
    }).catch(function (error) {
        toastr.error(error.response.data.message)
    });
}

function updateItem(url, id, data, redirectRoute) {
    axios.put(url + '/' + id, data).then(function (response) {
        if (redirectRoute != undefined) {
            // window.location.href = redirectRoute;
            toastr.success(response.data.message)
            setTimeout(function () {
                window.location.href = redirectRoute;
            }, 1500);
        } else {
            toastr.success(response.data.message);
        }
    }).catch(function (error) {
        toastr.error(error.response.data.message)
    });
}