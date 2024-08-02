<!-- Modal -->
<div class="modal fade" id="captureModal" tabindex="-1" role="dialog" aria-labelledby="captureModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="captureModalLabel">Capture Image and Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <video id="camera" width="100%" height="auto" autoplay></video>
                <canvas id="canvas" style="display:none;"></canvas>
                <div align="center">
                    <div id="capturedImageContainer" style="display:none;"></div>
                    <img id="capturedImage" src="" alt="Captured Image"
                         style="width: 100%; display: none; height: auto;">

                </div>
                <div align="center" class="mt-2">
                    <button id="captureButton" class="btn btn-primary">Capture</button>
                    <button id="retakeButton" class="btn btn-secondary" style="display:none;">Retake</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveButton" disabled>Submit and Report</button>
            </div>
        </div>
    </div><!-- Modal HTML -->
    <div class="modal fade" id="captureModal" tabindex="-1" role="dialog" aria-labelledby="captureModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="captureModalLabel">Capture Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Camera and capture elements -->
                    <video id="camera" autoplay></video>
                    <canvas id="canvas" style="display: none;"></canvas>
                    <div id="capturedImageContainer" style="display: none;"></div>
                    <img id="capturedImage" style="display: none;"/>
                    <button id="captureButton">Capture</button>
                    <button id="retakeButton" style="display: none;">Retake</button>
                    <button id="saveButton" disabled>Save</button>
                    <div id="loader" style="display: none;">Loading...</div>
                    <div id="successMessage" style="display: none;">Success!</div>
                </div>
            </div>
        </div>
    </div>

</div>
