<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin perpustakaan</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Perpustakaan RSUD Mohammad Noer</h1>
                    </div>

                    <!-- Search Bar -->
                    <div class="card shadow mb-4">
                        <div class="card-body bg-light">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <!-- Form Pencarian -->
                                <form action="{{ route('library') }}" method="GET" class="form-inline mb-2">
                                    <input type="text" name="keyword" class="form-control mr-2"
                                        placeholder="Kata Kunci" value="{{ request('keyword') }}"
                                        style="min-width:200px;">

                                    <select name="filter" class="form-control mr-2">
                                        <option value="judul" {{ request('filter') == 'judul' ? 'selected' : '' }}>
                                            Judul</option>
                                        <option value="penulis" {{ request('filter') == 'penulis' ? 'selected' : '' }}>
                                            Penulis</option>
                                        <option value="tahun" {{ request('filter') == 'tahun' ? 'selected' : '' }}>
                                            Tahun</option>
                                    </select>

                                    <select name="category_id" class="form-control mr-2">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->category_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-success">Cari</button>
                                </form>


                                <!-- Tombol Tambah Document -->
                                <button class="btn btn-sm btn-success shadow-sm mb-2" data-toggle="modal"
                                    data-target="#tambahDocumentModal">
                                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Document
                                </button>
                            </div>

                            <!-- Table -->
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Tahun</th>
                                        <th>Pembuat</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $doc)
                                        <tr>
                                            <td>{{ $doc->id }}</td>
                                            <td>{{ $doc->title }}</td>
                                            <td>{{ $doc->category->category_name }}</td>
                                            <td>{{ $doc->year_published }}</td>
                                            <td>{{ $doc->author }}</td>
                                            <td><a href="{{ asset('storage/' . $doc->file_url) }}"
                                                    target="_blank">Lihat File</a>
                                            </td>

                                            <td>
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#editDocumentModal{{ $doc->id }}">Edit</button>

                                                <!-- Tombol Hapus -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#confirmModal"
                                                    data-url="{{ route('library.destroy', $doc->id) }}">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- ✅ Pagination -->
                            <div class="d-flex justify-content-center">
                                {{ $documents->onEachSide(1)->links('pagination::bootstrap-4') }}
                            </div>

                        </div>
                    </div>

                    <!-- Modal Tambah Document -->
                    <div class="modal fade" id="tambahDocumentModal" tabindex="-1" role="dialog"
                        aria-labelledby="tambahDocumentLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form action="{{ route('library.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tambahDocumentLabel">Tambah Document</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form Input -->
                                        <div class="form-group">
                                            <label for="title">Judul</label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="author">Penulis</label>
                                            <input type="text" class="form-control" name="author" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="year_published">Tahun Terbit</label>
                                            <input type="number" class="form-control" name="year_published"
                                                min="1900" max="2099" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Kategori</label>
                                            <select class="form-control" name="category_id" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subcategory_id">Sub Kategori</label>
                                            <select class="form-control" name="subcategory_id">
                                                <option value="">-- Pilih Sub Kategori (opsional) --</option>
                                                @foreach ($subcategories as $sub)
                                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="file">Upload File (PDF,PNG)</label>
                                            <input type="file" class="form-control" name="file"
                                                accept=".pdf,.png" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Edit Document (Per Document) -->
                    @foreach ($documents as $doc)
                        <div class="modal fade" id="editDocumentModal{{ $doc->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="editDocumentLabel{{ $doc->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('library.update', $doc->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDocumentLabel{{ $doc->id }}">Edit
                                                Document</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form Edit -->
                                            <div class="form-group">
                                                <label for="title">Judul</label>
                                                <input type="text" class="form-control" name="title"
                                                    value="{{ $doc->title }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="author">Penulis</label>
                                                <input type="text" class="form-control" name="author"
                                                    value="{{ $doc->author }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="year_published">Tahun Terbit</label>
                                                <input type="number" class="form-control" name="year_published"
                                                    value="{{ $doc->year_published }}" min="1900" max="2099"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id">Kategori</label>
                                                <select class="form-control" name="category_id" required>
                                                    @foreach ($categories as $cat)
                                                        <option value="{{ $cat->id }}"
                                                            {{ $doc->category_id == $cat->id ? 'selected' : '' }}>
                                                            {{ $cat->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="file">Ganti File (Opsional)</label>
                                                <input type="file" class="form-control" name="file"
                                                    accept=".pdf,.doc,.docx">
                                                <small class="text-muted">Kosongkan jika tidak ingin mengganti
                                                    file.</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi (reusable) -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin untuk menghapus file?</h5>
                    <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    File ini akan dihapus secara permanen. Tekan <b>"Hapus"</b> untuk melanjutkan.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>

                    <!-- Form dinamis -->
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content text-center shadow-lg border-0 rounded animate__animated animate__zoomIn">
                    <div class="modal-body p-4">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <h5 class="text-success">{{ session('success') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script src="assets/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>
    <script>
        $('#confirmModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Tombol yang diklik
            var url = button.data('url') // Ambil data-url dari tombol
            var form = $(this).find('#deleteForm')
            form.attr('action', url) // Set action form
        })
    </script>
    <script>
        @if (session('success'))
            $(document).ready(function() {
                let modal = $('#successModal');
                modal.modal('show');

                // Tutup otomatis setelah 2.5 detik
                setTimeout(function() {
                    modal.modal('hide');
                }, 2500);
            });
        @endif
    </script>
</body>

</html>
