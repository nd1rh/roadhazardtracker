<div class="card mb-5 shadow-lg">

    <!-- Card Header -->
    <div class="card-header bg-secondary text-white d-flex align-items-center">
        <span>Report a New Road Hazard</span>
    </div>

    <div class="card-body p-4">
        <form method="POST" action="submit_hazard.php">

            <!-- Location -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Location Name</label>
                    <input type="text" class="form-control" name="location_name"
                        placeholder="Add a detailed location name" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Latitude</label>
                    <input type="number" step="any" class="form-control" name="latitude"
                        placeholder="e.g. 3.1415 (Refer to Google Maps)" required>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Longitude</label>
                    <input type="number" step="any" class="form-control" name="longitude"
                        placeholder="e.g. 101.6869 (Refer to Google Maps)" required>
                </div>
            </div>

            <!-- Hazard Type -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Hazard Type</label>
                    <select class="form-select" name="hazard_type" id="hazard_type" required>
                        <option value="">Select Hazard</option>
                        <option>Landslide</option>
                        <option>Flood</option>
                        <option>Road Closure</option>
                        <option>Potholes</option>
                        <option>Accidents</option>
                        <option>Road Construction</option>
                        <option>Fallen Trees</option>
                        <option>Uneven Road Surfaces</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="col-md-6 d-none" id="otherHazardDiv">
                    <label class="form-label fw-semibold">Specify Hazard</label>
                    <input type="text" class="form-control"
                        name="other_hazard_type"
                        placeholder="Describe the hazard">
                </div>
            </div>

            <!-- Reporter -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Reporter Name</label>
                    <input type="text" class="form-control"
                        name="reporter_name"
                        placeholder="Your name" required>
                </div>
            </div>

            <!-- Submit -->
            <div class="d-flex justify-content-end">
                <button type="submit" name="submit_hazard"
                    class="btn btn-success px-4">
                    Submit Report
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    document.getElementById('hazard_type').addEventListener('change', function() {
        const otherDiv = document.getElementById('otherHazardDiv');
        otherDiv.classList.toggle('d-none', this.value !== 'other');
    });
</script>