<div class="container pt-3">
    <h4><i class="bi bi-telephone-fill"></i> Contacts</h4>
    <div class="container all-contacts-container d-flex justify-content-around flex-wrap mt-3">
        <?php
        $getContact = $db->getHotlines();
        while ($contact = $getContact->fetch_assoc()) {
        ?>
            <div class="card p-3 hotline-container mt-3">
                <h4><?= $contact['HOTLINE_NAME'] ?></h4>
                <h6><?= $contact['NUMBER'] ?></h6>
            </div>
        <?php
        }
        ?>
    </div>
</div>