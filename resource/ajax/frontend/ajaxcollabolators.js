$(document).ready( function () {
  $(".collaboratorPoster").hover( function () {
    $(this).children(".imgPoster").addClass("d-none");
    $(this).children(".quoteArtist").removeClass("d-none");
  }, function () {
    $(this).children(".imgPoster").removeClass("d-none");
    $(this).children(".quoteArtist").addClass("d-none");
  });
});
