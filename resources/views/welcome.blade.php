<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Create a Course</title>
  <style>
    body {
      background-color: #1b1e2c;
      color: white;
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    input, select, textarea {
      width: 100%;
      padding: 8px;
      margin: 6px 0;
      border-radius: 5px;
      color: white;
      background-color: #2e3247;
      border: 1px solid #444;
    }
    button {
      padding: 8px 12px;
      margin: 5px 0;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .add-btn { background-color: #007bff; color: white; }
    .remove-btn { background-color: #dc3545; color: white; }
    .save-btn { background-color: #28a745; }
    .cancel-btn { background-color: #e74c3c; }
    .module, .content-block {
      border: 1px solid #444;
      padding: 15px;
      margin-bottom: 15px;
      border-radius: 6px;
      background-color: #2b2f45;
    }
    .content-block {
      margin-left: 20px;
    }
  </style>
</head>
<body>
<div class="card">
  <div class="row">
    <div class="col-md-8 offset-2 pt-4">
      <h2>Create a Course</h2>

      <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="course_title" class="form-label">Course Title</label>
              <input type="text" name="course_title" class="form-control" id="course_title">
              @error('course_title')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="feature_video" class="form-label">Feature Video</label>
              <input type="text" name="feature_video" class="form-control" id="feature_video">
              @error('feature_video')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <div id="modulesContainer"></div>

        <button type="button" class="btn btn-primary mt-2" onclick="addModule()">Add Module +</button>

        <div style="margin-top: 20px;">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  let moduleCount = 0;

  function addModule() {
    moduleCount++;
    const moduleId = `module-${moduleCount}`;

    const moduleHTML = `
      <div class="module" id="${moduleId}">
        <h5>Module ${moduleCount}</h5>
        <div class="mb-2">
          <label>Module Title</label>
          <input type="text" name="module_title[${moduleCount}]" class="form-control">
           @error('module_title')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="contents" id="contents-${moduleCount}"></div>

        <button type="button" class="btn btn-sm btn-light add-btn" onclick="addContent(${moduleCount})">Add Content +</button>
        <button type="button" class="btn btn-sm remove-btn" onclick="removeModule('${moduleId}')">Remove Module</button>
      </div>
    `;

    document.getElementById('modulesContainer').insertAdjacentHTML('beforeend', moduleHTML);
  }

  function removeModule(moduleId) {
    const moduleDiv = document.getElementById(moduleId);
    if (moduleDiv) moduleDiv.remove();
  }

  function addContent(moduleNumber) {
    const contentsContainer = document.getElementById(`contents-${moduleNumber}`);
    const contentId = `content-${moduleNumber}-${Date.now()}`;

    // <label>Content Title</label>
    /*<input type="text" name="modules[${moduleNumber}][contents][]" class="form-control" required>*/
    const contentHTML = `
      <div class="content-block" id="${contentId}">

        <div class="mb-3">
            <label for="content_title" class="form-label">Content title</label>
            <input type="text" name="content_title[${moduleNumber}][contents][]" class="form-control" id="content_title" aria-describedby="emailHelp">
            @error('content_title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="vedio_source_tytpe" class="form-label">Vedio Source Tytpe</label>
            <input type="text" name="vedio_source_type[${moduleNumber}][contents][]" class="form-control" id="vedio_source_tytpe" aria-describedby="emailHelp">
            @error('vedio_source_type')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="vedio_url" class="form-label">Vedio URL</label>
            <input type="text" name="vedio_url[${moduleNumber}][contents][]" class="form-control" id="vedio_url" aria-describedby="emailHelp">
            @error('vedio_url')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="vedio_length" class="form-label">Vedio Length</label>
            <input type="text" name="vedio_length[${moduleNumber}][contents][]" class="form-control" id="vedio_length" aria-describedby="emailHelp">
            @error('vedio_length')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="removeContent('${contentId}')">Remove Content</button>
      </div>
    `;

    contentsContainer.insertAdjacentHTML('beforeend', contentHTML);
  }

  function removeContent(contentId) {
    const contentDiv = document.getElementById(contentId);
    if (contentDiv) contentDiv.remove();
  }
</script>
</body>
</html>
