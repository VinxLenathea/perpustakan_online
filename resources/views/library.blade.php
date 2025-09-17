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
    <h1 class="h3 mb-0 text-gray-800">Library</h1>
</div>

<!-- Search Bar -->
<div class="card shadow mb-4">
    <div class="card-body bg-light">

        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <!-- Form Pencarian -->
            <form action="{{ route('library') }}" method="GET" class="form-inline mb-2">
                <!-- Input Kata Kunci -->
                <input type="text" name="keyword" class="form-control mr-2" placeholder="Kata Kunci" style="min-width:200px;">

                <!-- Dropdown Kategori -->
                <select name="filter" class="form-control mr-2">
                    <option value="judul">Judul</option>
                    <option value="penulis">Penulis</option>
                    <option value="tahun">Tahun</option>
                </select>

                <!-- Tombol Cari -->
                <button type="submit" class="btn btn-success">Cari</button>
            </form>

            <!-- Tombol Tambah Document -->
            <button class="btn btn-sm btn-success shadow-sm mb-2" data-toggle="modal" data-target="#tambahDocumentModal">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Document
            </button>
        </div>

    </div>
</div>


                    <!-- Modal Tambah Document -->
                    <div class="modal fade" id="tambahDocumentModal" tabindex="-1" role="dialog" aria-labelledby="tambahDocumentLabel" aria-hidden="true">
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

                                        <!-- Judul -->
                                        <div class="form-group">
                                            <label for="title">Judul</label>
                                            <input type="text" class="form-control" name="title" required>
                                        </div>

                                        <!-- Penulis -->
                                        <div class="form-group">
                                            <label for="author">Penulis</label>
                                            <input type="text" class="form-control" name="author" required>
                                        </div>

                                        <!-- Tahun -->
                                        <div class="form-group">
                                            <label for="year_published">Tahun Terbit</label>
                                            <input type="number" class="form-control" name="year_published" min="1900" max="2099" required>
                                        </div>

                                        <!-- Kategori -->
                                        <div class="form-group">
                                            <label for="category_id">Kategori</label>
                                            <select class="form-control" name="category_id" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Subkategori -->
                                        <div class="form-group">
                                            <label for="subcategory_id">Sub Kategori</label>
                                            <select class="form-control" name="subcategory_id">
                                                <option value="">-- Pilih Sub Kategori (opsional) --</option>
                                                @foreach($subcategories as $sub)
                                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Upload File -->
                                        <div class="form-group">
                                            <label for="file">Upload File (PDF/Doc)</label>
                                            <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx" required>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="assets/js/demo/chart-area-demo.js"></script>
    <script src="assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>

