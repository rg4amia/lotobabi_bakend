(function($) {
  "use strict";

  // Chat Users list
  if($('.chat-application .chat-Users-list').length > 0){
    var chat_user_list = new PerfectScrollbar(".chat-Users-list");
  }

  // Chat Users profile
  if($('.chat-application .profile-sidebar-area .scroll-area').length > 0){
    var chat_user_list = new PerfectScrollbar(".profile-sidebar-area .scroll-area");
  }

  // Chat area
  if($('.chat-application .Users-chats').length > 0){
    var chat_user = new PerfectScrollbar(".Users-chats");
  }

  // Users profile right area
  if($('.chat-application .Users-profile-sidebar-area').length > 0){
    var user_profile = new PerfectScrollbar(".Users-profile-sidebar-area");
  }

  // Chat Profile sidebar toggle
  $('.chat-application .sidebar-profile-toggle').on('click',function(){
    $('.chat-profile-sidebar').addClass('show');
    $('.chat-overlay').addClass('show');
  });

  // Users Profile sidebar toggle
  $('.chat-application .Users-profile-toggle').on('click',function(){
    $('.Users-profile-sidebar').addClass('show');
    $('.chat-overlay').addClass('show');
  });

  // Update status by clickin on Radio
  $('.chat-application .Users-status input:radio[name=userStatus]').on('change', function(){
    var $className = "avatar-status-"+this.value;
    $(".header-profile-sidebar .avatar span").removeClass();
    $(".sidebar-profile-toggle .avatar span").removeClass();
    $(".header-profile-sidebar .avatar span").addClass($className+" avatar-status-lg");
    $(".sidebar-profile-toggle .avatar span").addClass($className);
  });

  // On Profile close click
  $(".chat-application .close-icon").on('click',function(){
    $('.chat-profile-sidebar').removeClass('show');
    $('.Users-profile-sidebar').removeClass('show');
    if(!$(".sidebar-content").hasClass("show")){
      $('.chat-overlay').removeClass('show');
    }
  });

  // On sidebar close click
  $(".chat-application .sidebar-close-icon").on('click',function(){
    $('.sidebar-content').removeClass('show');
    $('.chat-overlay').removeClass('show');
  });

  // On overlay click
  $(".chat-application .chat-overlay").on('click',function(){
    $('.app-content .sidebar-content').removeClass('show');
    $('.chat-application .chat-overlay').removeClass('show');
    $('.chat-profile-sidebar').removeClass('show');
    $('.Users-profile-sidebar').removeClass('show');
  });

  // Add class active on click of Chat users list
  $(".chat-application .chat-Users-list ul li").on('click', function(){
    if($('.chat-Users-list ul li').hasClass('active')){
      $('.chat-Users-list ul li').removeClass('active');
    }
    $(this).addClass("active");
    $(this).find(".badge").remove();
    if($('.chat-Users-list ul li').hasClass('active')){
      $('.start-chat-area').addClass('d-none');
      $('.active-chat').removeClass('d-none');
    }
    else{
      $('.start-chat-area').removeClass('d-none');
      $('.active-chat').addClass('d-none');
    }
  });

  // Favorite star click
  $(".chat-application .favorite i").on("click", function(e) {
    $(this).parent('.favorite').toggleClass("warning");
    e.stopPropagation();
  });

  // Main menu toggle should hide app menu
  $('.chat-application .menu-toggle').on('click',function(e){
    $('.app-content .sidebar-left').removeClass('show');
    $('.chat-application .chat-overlay').removeClass('show');
  });

  // Chat sidebar toggle
  if ($(window).width() < 992) {
    $('.chat-application .sidebar-toggle').on('click',function(){
      $('.app-content .sidebar-content').addClass('show');
      $('.chat-application .chat-overlay').addClass('show');
    });
  }

  // For chat sidebar on small screen
  if ($(window).width() > 992) {
    if($('.chat-application .chat-overlay').hasClass('show')){
      $('.chat-application .chat-overlay').removeClass('show');
    }
  }

  // Scroll Chat area
  $(".Users-chats").scrollTop($(".Users-chats > .chats").height());

  // Filter
  $(".chat-application #chat-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    if(value!=""){
      $(".chat-Users-list .chat-users-list-wrapper li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    }
    else{
      // If filter box is empty
      $(".chat-Users-list .chat-users-list-wrapper li").show();
    }
  });

})(jQuery);

$(window).on("resize", function() {
  // remove show classes from sidebar and overlay if size is > 992
  if ($(window).width() > 992) {
    if($('.chat-application .chat-overlay').hasClass('show')){
      $('.app-content .sidebar-left').removeClass('show');
      $('.chat-application .chat-overlay').removeClass('show');
    }
  }

  // Chat sidebar toggle
  if ($(window).width() < 992) {
    if($('.chat-application .chat-profile-sidebar').hasClass('show')){
      $('.chat-profile-sidebar').removeClass('show');
    }
    $('.chat-application .sidebar-toggle').on('click',function(){
      $('.app-content .sidebar-content').addClass('show');
      $('.chat-application .chat-overlay').addClass('show');
    });
  }
});

// Add message to chat
function enter_chat(source) {
   var message = $(".message").val();
   if(message != ""){
  var html = '<div class="chat-content">' + "<p>" + message + "</p>" + "</div>";
  $(".chat:last-child .chat-body").append(html);
  $(".message").val("");
  $(".Users-chats").scrollTop($(".Users-chats > .chats").height());
   }
}
