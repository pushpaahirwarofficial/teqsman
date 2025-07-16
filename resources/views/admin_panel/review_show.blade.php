<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard | ITforSoftware</title>
    <link rel="stylesheet" href="/public/css/admin_style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include CKEditor 4 CSS -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">Add Post</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/admin_panel/blogs/create">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Add Blog</span>
                </a>
            </li>
            <li>
                <a href="/admin_panel/show_blogs" >
                    <i class="bx bx-box"></i>
                    <span class="links_name">Show Blog</span>
                </a>
            </li>
            <li>
                <a href="/admin_panel/review/create" >
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Add Review</span>
                </a>
            </li>
            
             <li>
                <a href="/admin_panel/show_reviews" class="active">
                    <i class="bx bx-box"></i>
                    <span class="links_name">Show Reviews</span>
                </a>
            </li>

            <li class="log_out">
                <a href="{{ route('admin_panel.logout') }}">
                    <i class="bx bx-log-out"></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>

        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebar-button">
                <i class="bx bx-menu sidebarBtn"></i>
                <span class="dashboard">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search..." />
                <i class="bx bx-search"></i>
            </div>
            <div class="profile-details">
                 <img src="/public/images/IT_for_Software_Logo.webp" alt="" />
                <span class="admin_name">Admin</span>
                <i class="bx bx-chevron-down"></i>
            </div>
        </nav>

        <div class="home-content">


            <style>
                @media (max-width: 640px) {
                    .sm\:hidden {
                        display: block !important;
                    }
                }
            </style>
            
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif
<style>
.no-underline {
    text-decoration: none; /* Remove underline by default */
}

.no-underline:hover {
    text-decoration: none; /* Ensure no underline on hover */
}
</style>
            <div class="container mt-4">
                <div class="row">
                    @foreach ($reviews as $review)
                    <div class="card mt-4" style="border: 1px solid #ccc;">
                        <div class="card-body" style="background-color: #f0f0f0;">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{ $review->img_url }}" alt="blog_Image" class="img-fluid h-100 w-100">
                                </div>
                                <div class="col-md-5">
                      <a href="{{ route('review.show', ['title_url' => $review->title_url]) }}" target="_blank" class="no-underline">
                              <h5 class="card-title w-100" style="color:black!important;">{{ $review->title }}</h5>
                      </a>
                     </div>
                               <div class="col-md-3">
                                    <!--<h5 class="mt-2">Update and Delete Reviews</h5>-->
                                    <a href="{{ route('admin_panel.review_show_update', ['id' => $review->id]) }}" class="btn btn-secondary text-white">Update</a>
                                    <a href="{{ route('admin_panel.review_delete', ['id' => $review->id]) }}" class="btn btn-secondary text-white"  onclick="return confirmDelete(this.href);">
   Delete</a>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
    return false; // Prevent the default link behavior until confirmation
}
</script>


                                </div>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>





        </div>


    </section>
    <div class="container mt-4 text-center" style="margin-left: 350px;">
                    @php
                    $perPage = 20; // Number of pagination links per row
                    $pages = ceil($reviews->total() / $perPage); // Total number of pages
                    @endphp

                    @for ($i = 0; $i < $pages; $i++) <div class="row">
                        <div class="col-md-12 mt-2">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    @for ($j = 1; $j <= $perPage; $j++) @php $pageNumber=$i * $perPage + $j; @endphp @if ($pageNumber <=$reviews->lastPage())
                                        <li class="page-item {{ $pageNumber == $reviews->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ route('admin_panel.review_show', ['page' => $pageNumber]) }}">{{ $pageNumber }}</a>
                                        </li>
                                        @endif
                                        @endfor
                                </ul>
                            </nav>
                        </div>
                </div>
                @endfor

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };

        CKEDITOR.replace('body', {
            'width': '140vh',

            // Customize CKEditor as needed
        });
    </script>
</body>

</html>


<!-- resources/views/blogs/create.blade.php -->