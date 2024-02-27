<!-- Open the modal using ID.showModal() method -->
<dialog id="createPlaylist" class="modal modal-middle">
    <div class="modal-box bg-white">
        <form action="{{ route('playlist.create.post') }}" method="POST" class="relative">
            @csrf
            <h3 class="font-bold text-lg mb-5">Tambah Playlist</h3>

            @error('playlistId.*')
                @include('admin.video._alertError')
            @enderror

            <div class="mt-10">
                <label for="playlist">Pilih Playlist</label>
                <div class="mt-2">
                    <select class="playlistCreateValue  w-full" name="playlistId[]" multiple="multiple" id="playlist">

                        @foreach ($allPlaylist->data->items as $item)
                            <option value="{{ $item->id }}"
                                {{ in_array($item->id, old('playlistId', [])) ? 'selected' : '' }}>
                                {{ $item->snippet->title }}</option>
                        @endforeach
                    </select>
                </div>
                @isset($allPlaylist->data->nextPageToken)
                    <div class="flex flex-col gap-2 mt-2">
                        <div id="btnNextTokenArea" class="flex gap-2 items-center">
                            <button type="button" data-value="{{ $allPlaylist->data->nextPageToken }}" id="btnNextToken"
                                class="font-semibold">Tampilkan Data Lainnya</button>
                            <div role="status" id="btnNextTokenLoader" class="hidden">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin  fill-Sidebar"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div id="errorAlertNextToken"
                                class="hidden flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                                role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <div class="ms-3 text-sm font-medium">
                                    Tidak dapat memuat data, silahkan refresh atau hubungi developer
                                </div>
                                <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#errorAlertNextToken" aria-label="Close">
                                    <span class="sr-only">Dismiss</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="succesAlertNextBtn"
                            class="hidden flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ms-3 text-sm font-medium" id="alertSuccessMessage">

                            </div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#succesAlertNextBtn" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                        <div id="AlertDoneShowAllData"
                            class="hidden flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <div class="ms-3 text-sm font-medium" id="AlertDoneShowAllDataMessage">

                            </div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#AlertDoneShowAllData" aria-label="Close">
                                <span class="sr-only">Dismiss</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endisset

            </div>
            <div class="flex gap-2 justify-end pt-5">
                <label for="closeModalCreate"
                    class="btn bg-red-700 text-white border-none hover:bg-red-600">Batal</label>
                <button type="submit"
                    class="btn bg-Sidebar text-white border-none hover:bg-SidebarActive">Simpan</button>
            </div>
        </form>
        <div class="modal-action hidden">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" id="closeModalCreate">Close</button>
            </form>
        </div>
    </div>
</dialog>




@push('head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection.select2-selection--multiple {
            min-height: 50px;
            padding-top: 7px;
            padding-left: 7px;
        }
    </style>
@endpush


@push('scripts')
    @if ($errors->any())
        <script>
            // Buka modal jika terdapat kesalahan validasi
            document.addEventListener('DOMContentLoaded', function() {
                createPlaylist.showModal();
            });
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            const btnNextToken = $('#btnNextToken');
            const btnNextTokenLoad = $('#btnNextTokenLoader');
            const errorAlertNextToken = $('#errorAlertNextToken');
            const succesAlertNextBtn = $('#succesAlertNextBtn');
            const alertSuccessMessage = $('#alertSuccessMessage');
            const AlertDoneShowAllData = $('#AlertDoneShowAllData');

            $('.playlistCreateValue').select2({
                dropdownParent: $('#createPlaylist'),
                width: 'resolve',
                placeholder: "Pilih Playlist",
                language: {
                    noResults: function() {
                        return "Data tidak ditemukan atau sudah ditambahkan sebelumnya, Silahkan periksa kembali.";
                    }
                }
            });

            let oldRequest = @json(old('playlistId', []));

            btnNextToken.on('click', function() {
                if (btnNextToken.attr('disabled') === undefined) {
                    return pageToken();
                }
            });

            function closeAlertSuccess(alertId) {
                const alert = document.getElementById(alertId);
                alert.classList.add('hidden');
            }

            function showLoadAndDisableBtn() {
                btnNextToken.attr('disabled', true);
                btnNextToken.addClass('text-gray-600');

                btnNextTokenLoad.removeClass('hidden');
            }

            function hideLoadAndEnableBtn() {
                btnNextToken.attr('disabled', false);
                btnNextToken.removeClass('text-gray-600').addClass('text-black');

                btnNextTokenLoad.addClass('hidden');
            }

            function showSuccessAlert(message) {
                succesAlertNextBtn.removeClass('hidden');
                alertSuccessMessage.html(message);
            }

            function hideSuccessAlert() {
                succesAlertNextBtn.addClass('hidden');
            }

            function pageToken() {
                let token = btnNextToken.data('value');
                let btnArea = $('#btnNextTokenArea');
                $.ajax({
                    method: 'GET',
                    url: `{{ route('playlist.index') }}`,
                    data: {
                        ajaxPageToken: token,
                    },
                    beforeSend: function() {
                        showLoadAndDisableBtn();
                        errorAlertNextToken.addClass('hidden');
                        hideSuccessAlert();
                        $('.playlistCreateValue').attr('disabled', true);
                        AlertDoneShowAllData.addClass('hidden');

                    },
                    success: function(response) {
                        if (response.data && response.data.items) {
                            response.data.items.forEach(item => {
                                $('.playlistCreateValue').append(
                                    `<option value="${item.id}" ${!oldRequest.includes(item.id)}>${item.snippet.title}</option>`
                                ).trigger('change');
                            });

                            if (response.data.nextPageToken !== undefined) {
                                btnNextToken.data('value', response.data.nextPageToken);
                                showSuccessAlert('Berhasil menampilkan data, silahkan dicek lagi');
                            } else {
                                btnNextToken.data('value', null);
                                btnArea.html('');

                                // hide alert 'sudah menampilkan semua data' dan mengisi messagenya
                                AlertDoneShowAllData.removeClass('hidden');
                                $('#AlertDoneShowAllDataMessage').html('Berhasil menampilkan data, Semua data sudah ditampilkan');
                            }
                        }
                        hideLoadAndEnableBtn();
                        $('.playlistCreateValue').attr('disabled', false);
                    },
                    error: function(error) {
                        hideLoadAndEnableBtn()
                        errorAlertNextToken.removeClass('hidden');
                    }
                });
            }
        });
    </script>
@endpush
