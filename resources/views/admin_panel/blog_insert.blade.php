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
 
    
    <!--<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

   
    
<!--summernote-->
 <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <!-- Include CKEditor 4 CSS -->
    <!--<link rel="stylesheet" href="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.css">-->
</head>

<style>
    .note-dropdown-item h1{
        font-size:23px!important;
    }
    .note-dropdown-item h2{
        font-size:22px!important;
    }
    .note-dropdown-item h3{
        font-size:21px!important;
    }
    .note-dropdown-item h4{
        font-size:20px!important;
    }
    .note-dropdown-item h5{
        font-size:19px!important;
    }
    .note-dropdown-item h6{
        font-size:18px!important;
    }
    
</style>

<body>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bxl-c-plus-plus"></i>
            <span class="logo_name">Add Post</span>
        </div>
        <ul class="nav-links">
            <li>
                <a href="/admin_panel/blogs/create" class="active">
                    <i class="bx bx-grid-alt"></i>
                    <span class="links_name">Add Blog</span>
                </a>
            </li>
            <li>
                <a href="/admin_panel/show_blogs">
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
                <a href="/admin_panel/show_reviews" >
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
            <div class="container">
                 
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

                <form action="{{ route('admin_panel.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="mb-0">Blog Title:</label>
                            <input type="text" id="title" name="title" oninput="generateURL()" required class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title_url "class="mb-0">Make Blog Url:</label>
                            <input type="text" id="title_url" name="title_url" required class="form-control">
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-md-6 mb-3">
                            <label for="meta_title" class="mb-0">Meta Title</label><br>
                            <input type="text" id="meta_title" name="meta_title" required class="form-control">
                        </div>
                        
                         <div class="col-md-6 mb-3">
                            <label for="meta_desc"class="mb-0">Meta Description:</label>
                            <input type="text" id="meta_desc" name="meta_desc" class="form-control">
                        </div>
                        
                    </div>
                    <div class="row">
                       
                       <div class="col-md-6 mb-3">
                            <label for="meta_key" class="mb-0">Meta Keyword:</label>
                            <input type="text" id="meta_key" name="meta_key" class="form-control">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="auth_name" class="mb-0">Author Name</label><br>
                            <input type="text" id="auth_name" name="auth_name" required class="form-control">
                        </div>
                        
                      
                    </div>
                    <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="description" class="mb-0"> Author Description:</label>
                            <input type="text" id="description" name="description" required class="form-control">
                        </div>
                            <div class="col-md-6 mb-3">
                            <label for="category" class="mb-0">Category:</label>
                            <select id="category" name="category" required class="form-control">
                                <option value="live-chat">Live Chat</option>
                                <option value="modem">Modem</option>
                                <option value="mail">Mail</option>
                                <option value="activation">Activation</option>
                                <option value="bill-pay">Bill Pay</option>
                                <option value="repair">Repair</option>
                                <option value="remote">Remote</option>
                                <option value="netflix">Netflix</option>
                                <option value="reset">Reset</option>
                                <option value="outage">Outage</option>
                                <option value="mail">Mail</option>
                                <option value="contacting">Contacting</option>
                                <option value="phone-number">Phone Number</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6 mb-3">
                            <label for="img_url" class="mb-0">Upload Image:</label>
                            <input type="file" id="img_url" name="img_url" required class="form-control-file">
                        </div>

                    
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12 mb-3">
                            <!--<label for="body" class="mb-0">Blog Long Description</label>-->
                            <!--<textarea id="body" name="body" required class="form-control"></textarea>-->
                             <label for="summernote"class="mb-0">Blog Long Description</label>
                          <textarea id="summernote" name="body" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        let sidebar = document.querySelector(".sidebar");
        let sidebarBtn = document.querySelector(".sidebarBtn");
        sidebarBtn.onclick = function() {
            sidebar.classList.toggle("active");
            if (sidebar.classList.contains("active")) {
                sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
        };

        // CKEDITOR.replace('body', {
        //     'width': '140vh',

        //     // Customize CKEditor as needed
        // });
    </script>
        
<script>
      $('#summernote').summernote({
        // placeholder: 'Describe your experience, skills, etc. In complete details. This is your chance to show off.',
        tabsize: 2,
        height: 320,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview']],
            
        ]
      });
    </script>
    
      <script>
        function generateURL() {
            // Get the value of the 'title' field
            let title = document.getElementById('title').value;

            // Convert title to lowercase and replace spaces with '-'
            let url = title.toLowerCase().replace(/\s+/g, '-');

            // Remove special characters using regular expression
            url = url.replace(/[^\w-]/g, '');

            // Update the 'title_url' field with the generated URL
            document.getElementById('title_url').value = url;
        }
    </script>
</body>

</html>


<!-- resources/views/blogs/create.blade.php -->