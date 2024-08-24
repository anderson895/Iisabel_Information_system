<!-- contact.php -->
<div class="modal" tabindex="-1" role="dialog" id="contactAddContact">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-telephone-fill"></i> Add Contact</h5>
            </div>
            <form id="contactFrmAddContact">
                <input type="hidden" name="SubmitType" value="AddNewContact">
                <div class="modal-body">
                    <div class="">
                        <label for="contactName">Contact Name:</label>
                        <input type="text" class="form-control mt-1" name="contactName" id="contactName" required>
                    </div>
                    <div class="mt-3">
                        <label for="contactNo">Contact No:</label>
                        <input type="text" class="form-control mt-1" name="contactNo" id="contactNo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="contactEditContact">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-telephone-fill"></i> Edit Contact</h5>
            </div>
            <form id="contactFrmEditContact">
                <input type="hidden" name="SubmitType" value="EditContact">
                <input type="hidden" name="editHotlineId" id="editHotlineId" value="">
                <div class="modal-body">
                    <div class="">
                        <label for="EditContactName">Contact Name:</label>
                        <input type="text" class="form-control mt-1" name="EditContactName" id="EditContactName" required>
                    </div>
                    <div class="mt-3">
                        <label for="EditContactNo">Contact No:</label>
                        <input type="text" class="form-control mt-1" name="EditContactNo" id="EditContactNo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of contact.php -->

<!-- news.php -->
<div class="modal" tabindex="-1" role="dialog" id="newsAddNewsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-newspaper"></i> Add News Update</h5>
            </div>
            <form id="newsFrmAddNews">
                <input type="hidden" name="SubmitType" value="AddNewsUpdate">
                <div class="modal-body">
                    <div class="">
                        <label for="newsName">Name:</label>
                        <input type="text" class="form-control mt-1" name="newsName" id="newsName" required>
                    </div>
                    <div class="">
                        <label for="newsDescription">Description:</label>
                        <input type="text" class="form-control mt-1" name="newsDescription" id="newsDescription" required>
                    </div>
                    <div class="mt-3">
                        <label for="newsAddress">Address:</label>
                        <input type="text" class="form-control mt-1" name="newsAddress" id="newsAddress" required>
                    </div>
                    <div class="mt-3">
                        <label for="newsMap">Map:</label>
                        <textarea class="form-control mt-1" name="newsMap" id="newsMap" required></textarea>
                    </div>
                    <div class="mt-3">
                        <label for="newsDate">Date:</label>
                        <input type="date" class="form-control mt-1" name="newsDate" id="newsDate" required>
                    </div>
                    <div class="mt-3">
                        <label for="newsTime">Time:</label>
                        <input type="time" class="form-control mt-1" name="newsTime" id="newsTime" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="newsEditNewsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-newspaper"></i> Edit News</h5>
            </div>
            <form id="newsFrmEditNews">
                <input type="hidden" name="SubmitType" value="EditNews">
                <input type="hidden" name="newsId" id="newsId" value="">
                <div class="modal-body">
                    <div class="">
                        <label for="EditNewsName">Name:</label>
                        <input type="text" class="form-control mt-1" name="EditNewsName" id="EditNewsName" required>
                    </div>
                    <div class="">
                        <label for="EditNewsDescription">Description:</label>
                        <input type="text" class="form-control mt-1" name="EditNewsDescription" id="EditNewsDescription" required>
                    </div>
                    <div class="mt-3">
                        <label for="EditNewsAddress">Address:</label>
                        <input type="text" class="form-control mt-1" name="EditNewsAddress" id="EditNewsAddress" required>
                    </div>
                    <div class="mt-3">
                        <label for="EditNewsDate">Date:</label>
                        <input type="date" class="form-control mt-1" name="EditNewsDate" id="EditNewsDate" required>
                    </div>
                    <div class="mt-3">
                        <label for="EditNewsTime">Time:</label>
                        <input type="time" class="form-control mt-1" name="EditNewsTime" id="EditNewsTime" required>
                    </div>
                    <div class="mt-3">
                        <label for="EditNewsMap">Map:</label>
                        <textarea class="form-control mt-1" name="EditNewsMap" id="EditNewsMap" required></textarea>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <label for="MapPrev">Map Preview:</label>
                        <div id="MapPrev" class="mt-3" style="max-width: 100%; overflow: auto;">

                        </div>
                    </div>
                    <hr>
                    <div>
                        <center>
                            <h5>Images</h5>
                        </center>
                        <button type="button" class="btn btn-dark" id="btnNewsAddNewImage" data-id=""><i class="bi bi-plus-square"></i> Add Image</button>
                        <div class="images-container text-center" id="newsImgContainer">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="NewsAddImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cloud-arrow-up"></i> New Image</h5>
            </div>
            <form id="frmNewsUploadImage">
                <div class="modal-body">
                    <input type="hidden" value="newsUploadImg" name="SubmitType">
                    <input type="hidden" value="" name="id" id="addImgNewsId">
                    <div class="">
                        <label for="newsImg" style="margin-left: 5px;">Upload Here:</label>
                        <input type="file" class="form-control mt-1" name="newsImg" id="newsImg" required accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End of news.php -->


<!-- tourist-spot.php -->
<div class="modal" tabindex="-1" role="dialog" id="tsAddModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-card-image"></i> Add Tourist Spot</h5>
            </div>
            <form id="tsFrmAddTs">
                <input type="hidden" name="SubmitType" value="AddTouristSpot">
                <div class="modal-body">
                    <div class="">
                        <label for="spotName">Name:</label>
                        <input type="text" class="form-control mt-1" name="spotName" id="spotName" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotType">Spot Type:</label>
                        <select id="spotType" class="form-control" required name="spotType">
                            <option value="Lake">Lake</option>
                            <option value="Beach">Beach</option>
                            <option value="Mountain">Mountain</option>
                            <option value="City View">City View</option>
                            <option value="River">River</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="spotDescription">Description:</label>
                        <input type="text" class="form-control mt-1" name="spotDescription" id="spotDescription" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotAddress">Address:</label>
                        <input type="text" class="form-control mt-1" name="spotAddress" id="spotAddress" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotFee">Fee:</label>
                        <input type="number" class="form-control mt-1" name="spotFee" id="spotFee" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotMap">Map:</label>
                        <textarea class="form-control mt-1" name="spotMap" id="spotMap" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="tsEditModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-card-image"></i> Edit Tourist Spot</h5>
            </div>
            <form id="tsFrmEditTs">
                <input type="hidden" name="SubmitType" value="EditTouristSpot">
                <input type="hidden" name="id" id="spotEditId">
                <div class="modal-body">
                    <div class="">
                        <label for="spotEditName">Name:</label>
                        <input type="text" class="form-control mt-1" name="spotEditName" id="spotEditName" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotEditType">Spot Type:</label>
                        <select id="spotEditType" class="form-control" required name="spotEditType">
                            <option value="Lake">Lake</option>
                            <option value="Beach">Beach</option>
                            <option value="Mountain">Mountain</option>
                            <option value="City View">City View</option>
                            <option value="River">River</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="spotEditDescription">Description:</label>
                        <input type="text" class="form-control mt-1" name="spotEditDescription" id="spotEditDescription" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotEditAddress">Address:</label>
                        <input type="text" class="form-control mt-1" name="spotEditAddress" id="spotEditAddress" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotEditFee">Fee:</label>
                        <input type="number" class="form-control mt-1" name="spotEditFee" id="spotEditFee" required>
                    </div>
                    <div class="mt-3">
                        <label for="spotEditMap">Map:</label>
                        <textarea class="form-control mt-1" name="spotEditMap" id="spotEditMap" required></textarea>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <label for="MapPrevTs">Map Preview:</label>
                        <div id="MapPrevTs" class="mt-3" style="max-width: 100%; overflow: auto;">

                        </div>
                    </div>
                    <hr>
                    <div>
                        <center>
                            <h5>Images</h5>
                        </center>
                        <button type="button" class="btn btn-dark" id="btnTouristSpotAddNewImage" data-id=""><i class="bi bi-plus-square"></i> Add Image</button>
                        <div class="images-container text-center" id="spotsImgContainer">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="TouristSpotAddImageModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-cloud-arrow-up"></i> New Image</h5>
            </div>
            <form id="frmTouristSpotUploadImage">
                <div class="modal-body">
                    <input type="hidden" value="spotUploadImg" name="SubmitType">
                    <input type="hidden" value="" name="id" id="addImgSpotId">
                    <div class="">
                        <label for="spotImg" style="margin-left: 5px;">Upload Here:</label>
                        <input type="file" class="form-control mt-1" name="spotImg" id="spotImg" required accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-secondary btnCloseModal" id="btnCloseModal" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of tourist-spot.php -->