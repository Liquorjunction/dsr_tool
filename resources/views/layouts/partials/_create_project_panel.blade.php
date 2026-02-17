<div class="offcanvas offcanvas-end" tabindex="-1" id="createNewProject" aria-labelledby="createNewProjectLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="createNewProjectLabel">Create New Project</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form action="#" method="POST">
      @csrf
      <div class="mb-3">
        <label for="projectName" class="form-label">Project Name</label>
        <input type="text" class="form-control" id="projectName" name="name" placeholder="Enter project name">
      </div>
      <div class="mb-3">
        <label for="projectDesc" class="form-label">Description</label>
        <textarea class="form-control" id="projectDesc" name="description" rows="3"></textarea>
      </div>
      <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="offcanvas">Cancel</button>
        <button type="submit" class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>
