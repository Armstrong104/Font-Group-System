$(document).ready(function () {
  // Handle file upload
  $("#fontUpload").change(function () {
    var file_data = $("#fontUpload").prop("files")[0];
    var form_data = new FormData();
    form_data.append("file", file_data);

    $.ajax({
      url: "upload.php", // Point to server-side upload script
      type: "POST",
      dataType: "text",
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      success: function (response) {
        alert("Font uploaded successfully!");
        // Refresh font list
        loadFonts();
      },
      error: function () {
        alert("Error uploading font.");
      },
    });
  });

  // Load fonts into the list
  function loadFonts() {
    $.ajax({
      url: "list_fonts.php",
      method: "GET",
      success: function (data) {
        $("#fontList").html(data);
        updateFontOptions();
      },
    });
  }

  // // Populate font select fields
  // function updateFontOptions() {
  //     $.ajax({
  //         url: 'list_fonts.php',
  //         method: 'GET',
  //         success: function(data) {
  //             $('.font-select').each(function() {
  //                 $(this).html(data); // Populate select with available fonts
  //             });
  //         }
  //     });
  // }

  // Populate font select fields
  function updateFontOptions() {
    $.ajax({
      url: "list_fonts.php?forSelect=1", // Send a query to get options only
      method: "GET",
      success: function (data) {
        $(".font-select").each(function () {
          $(this).html(data); // Populate select fields with fonts
        });
      },
      error: function () {
        alert("Error loading font options.");
      },
    });
  }

  // Add row for font selection
  $("#addRow").click(function () {
    var newRow = `
        <div class="row mb-2 font-group-row">
            <div class="col">
                <select class="font-select form-select" aria-label="Font selection">
                    <!-- Options will be populated -->
                </select>
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-danger removeRow">Remove</button>
            </div>
        </div>`;
    $("#fontGroupFields").append(newRow);
    updateFontOptions();
  });

  // Delegate event listener to dynamically created elements
  $(document).on("click", ".removeRow", function () {
    $(this).closest(".font-group-row").remove(); // Remove the entire row containing the button
  });

  // Handle form submission for creating font group
  $("#fontGroupForm").submit(function (e) {
    e.preventDefault();
    var selectedFonts = [];
    $(".font-select").each(function () {
      selectedFonts.push($(this).val());
    });

    if (selectedFonts.length < 2) {
      alert("Please select at least two fonts.");
      return;
    }

    $.ajax({
      url: "create_group.php",
      method: "POST",
      data: { fonts: selectedFonts },
      success: function () {
        alert("Font group created successfully!");
        loadFontGroups();
      },
    });
  });

  // Load font groups into the list
  function loadFontGroups() {
    $.ajax({
      url: "list_groups.php",
      method: "GET",
      success: function (data) {
        $("#fontGroupList").html(data);
      },
    });
  }

  // Initial load of fonts and groups
  loadFonts();
  loadFontGroups();
});
