
function filePondConfig(folder, CSRF, targetValue, btnSubmit) {
    // const filePondPostRoute = `{{ route('filePond.post') }}`;
    // const filePondDeleteRoute = `{{ route('filePond.delete', ['folder' => ': folder']) }}`;
    const filePondPostRoute = '/filePond/post/' + folder;
    const filePondDeleteRoute = `/filePond/delete/` + folder;

    // Turn input element into a pond with configuration options
    
    var nameImage = [];
    var deleteImage = [];

    FilePond.setOptions({
        maxFiles: 4,
        server: {
            process: {
                url: filePondPostRoute,
                onload: (response) => {
                    // console.log('res ' + response)
                    nameImage.push(response);
                    // console.log(nameImage);
                    $(targetValue).val(nameImage);
                    return response;
                },
                headers: {
                    'X-CSRF-TOKEN': CSRF
                }
            },
            revert: (uniqueFileId, load, error) => {
                if (uniqueFileId !== null) {
                    // Hapus file dari nameImage dan tambahkan ke deleteImage
                    var deletedFileName = nameImage.find((fileName) => fileName ===
                        uniqueFileId);
                    if (deletedFileName) {
                        axios.post(filePondDeleteRoute, {
                            imageName: deletedFileName,
                        })
                            .then(response => {
                                // Hapus dari nameImage dan tambahkan ke deleteImage
                                deleteImage.push(deletedFileName);
                                nameImage = nameImage.filter((fileName) => fileName !==
                                    uniqueFileId);
                                $(targetValue).val(nameImage);
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                }
            }


        },
        undo: false
    });

    // delete image jika gk tekan tombol submit
    let btnSubmitDiTekan = false;
    $(btnSubmit).on('click', function () {
        btnSubmitDiTekan = true;
        $(targetValue).val(nameImage);
        
    });
    $(window).on('beforeunload', function () {
        if (!btnSubmitDiTekan) {
            if (nameImage !== null) {
                nameImage.forEach(element => {
                    axios.post(filePondDeleteRoute, {
                        imageName: element,
                    })
                        .then(response => {
                        })
                        .catch(error => {
                        });
                });
            }
        }
    });

}