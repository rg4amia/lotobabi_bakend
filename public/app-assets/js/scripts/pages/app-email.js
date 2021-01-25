//  Notifications & messages scrollable

$(function () {
  "use strict";

  var Font = Quill.import('formats/font');
  Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
  Quill.register(Font, true);

  // Email left Sidebar
  if ($('.sidebar-menu-list').length > 0) {
    var sidebar_menu_list = new PerfectScrollbar(".sidebar-menu-list");
  }

  // Users list scroll
  if ($('.email-Users-list').length > 0) {
    var users_list = new PerfectScrollbar(".email-Users-list");
  }

  // Email detail section
  if ($('.email-scroll-area').length > 0) {
    var users_list = new PerfectScrollbar(".email-scroll-area");
  }

  // Modal dialog scroll
  if ($('.modal-dialog-scrollable .modal-body').length > 0) {
    var sidebar_menu_list = new PerfectScrollbar(".modal-dialog-scrollable .modal-body");
  }

  // Main menu toggle should hide app menu
  $('.menu-toggle').on('click', function (e) {
    $('.app-content .sidebar-left').removeClass('show');
    $('.app-content .app-content-overlay').removeClass('show');
  });

  // On sidebar close click
  $(".email-application .sidebar-close-icon").on('click', function () {
    $('.sidebar-left').removeClass('show');
    $('.app-content-overlay').removeClass('show');
  });

  // Email sidebar toggle
  $('.sidebar-toggle').on('click', function (e) {
    e.stopPropagation();
    $('.app-content .sidebar-left').toggleClass('show');
    $('.app-content .app-content-overlay').addClass('show');
  });
  $('.app-content .app-content-overlay').on('click', function (e) {
    $('.app-content .sidebar-left').removeClass('show');
    $('.app-content .app-content-overlay').removeClass('show');
  });

  // Email Right sidebar toggle
  $('.email-app-list .email-Users-list li').on('click', function (e) {
    $('.app-content .email-app-details').toggleClass('show');
  });

  // Add class active on click of sidebar list
  $(".email-application .list-group-messages a").on('click', function () {
    if ($('.email-application .list-group-messages a').hasClass('active')) {
      $('.email-application .list-group-messages a').removeClass('active');
    }
    $(this).addClass("active");
  });

  // Email detail view back button click
  $('.go-back').on('click', function (e) {
    e.stopPropagation();
    $('.app-content .email-app-details').removeClass('show');
  });

  // For app sidebar on small screen
  if ($(window).width() > 768) {
    if ($('.app-content .app-content-overlay').hasClass('show')) {
      $('.app-content .app-content-overlay').removeClass('show');
    }
  }
  // Favorite star click
  $(".email-application .favorite i").on("click", function (e) {
    $(this).parent('.favorite').toggleClass("warning");
    e.stopPropagation();
  });

  // On checkbox click stop propogation
  $(".email-Users-list .vs-checkbox-con input").on("click", function (e) {
    e.stopPropagation();
  });

  // Select all checkbox
  $(document).on("click", ".email-app-list .selectAll input", function () {
    $(".Users-action .vs-checkbox-con input").prop('checked', this.checked);
  });

  // Delete Mail from list
  $(".email-application .mail-delete").on("click", function () {
    $(".email-application .Users-action .vs-checkbox-con input:checked").closest("li").remove();
    $(".email-application .selectAll input").prop('checked', "");
  });

  // Mark mail unread
  $(".email-application .mail-unread").on("click", function () {
    $(".email-application .Users-action .vs-checkbox-con input:checked").closest("li").removeClass("mail-read");
  });

  // Filter
  $(".email-app-list #email-search").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    if (value != "") {
      $(".email-Users-list .users-list-wrapper li").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
      var tbl_row = $(".email-Users-list .users-list-wrapper li:visible").length; //here tbl_test is table name

      //Check if table has row or not
      if (tbl_row == 0) {
        $('.email-Users-list .no-results').addClass('show');
      }
      else {
        if ($('.email-Users-list .no-results').hasClass('show')) {
          $('.email-Users-list .no-results').removeClass('show');
        }
      }
    }
    else {
      // If filter box is empty
      $(".email-Users-list .users-list-wrapper li").show();
      if ($('.email-Users-list .no-results').hasClass('show')) {
        $('.email-Users-list .no-results').removeClass('show');
      }
    }
  });

  // Email compose Editor

  var emailEditor = new Quill('#email-container .editor', {
    bounds: '#email-container .editor',
    modules: {
      'formula': true,
      'syntax': true,
      'toolbar': [
        ['bold', 'italic', 'underline', 'strike', 'link', 'blockquote', 'code-block',
          {
            'header': '1'
          }, {
            'header': '2'
          }, {
            'list': 'ordered'
          }, {
            'list': 'bullet'
          }],
        [{
          'font': []
        }]
      ],
    },
    placeholder: 'Message',
    theme: 'snow'
  });

  var editors = [emailEditor];

});

$(window).on("resize", function () {
  // remove show classes from sidebar and overlay if size is > 992
  if ($(window).width() > 768) {
    if ($('.app-content .app-content-overlay').hasClass('show')) {
      $('.app-content .sidebar-left').removeClass('show');
      $('.app-content .app-content-overlay').removeClass('show');
    }
  }
});
