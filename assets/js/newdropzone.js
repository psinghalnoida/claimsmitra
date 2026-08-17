(function() {
  // WARNING: This solution doesn't work on IE. It was tested only on Chrome
  var DropZone;

  DropZone = class DropZone {
    constructor() {
      // TODO: .has-image has to be removed when remove all images
      // TODO: Generate uniq id and add to input.has-image and .preview 
      //       in order to remove them both when click on .remove

      // Hide input.receiver and insert the new one
      this.onchange = this.onchange.bind(this);
      this.dropZone = $('.drop-zone');
      // Add/Remove .is-dragover when hover/leave
      this.dropZone.on('dragover dragenter', () => {
        return this.dropZone.addClass('is-dragover');
      });
      this.dropZone.on('dragleave dragend drop', () => {
        return this.dropZone.removeClass('is-dragover');
      });
      this.dropZone.on('change', this.onchange);
    }

    onchange(e) {
      var $receiver, files;
      this.dropZone.addClass('has-images');
      
      // Rename input.receiver => input.has-image
      $receiver = $(e.target);
      $receiver.removeClass('receiver');
      $receiver.addClass('has-image');
      // Add new .receiver
      $('<input type="file" class="receiver">').prependTo(this.dropZone);
      // Preview
      files = $receiver[0].files;
      return this.displayPreview(files);
    }

    displayPreview(files) {
      var file, i, len, reader, results;
      results = [];
      for (i = 0, len = files.length; i < len; i++) {
        file = files[i];
        reader = new FileReader();
        reader.onload = (e) => {
          var url;
          url = e.currentTarget.result;
          return this.template(url).appendTo(this.dropZone);
        };
        results.push(reader.readAsDataURL(file));
      }
      return results;
    }

    template(url) {
      return $(`<div class="preview">
                <div class="image">
                  <img src="${url}">
                </div>
                <div class="details">
                  <div class="remove">
                  <span class="fa fa-trash"></span>
                  </div>
                </div>
              </div>`);
    }

  };

  new DropZone();

}).call(this);

//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsiPGFub255bW91cz4iXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQXlFO0VBQUE7QUFBQSxNQUFBOztFQUNuRSxXQUFOLE1BQUEsU0FBQTtJQUNFLFdBQWEsQ0FBQSxDQUFBLEVBQUE7Ozs7OztVQWNiLENBQUEsZUFBQSxDQUFBO01BYkUsSUFBQyxDQUFBLFFBQUQsR0FBWSxDQUFBLENBQUUsWUFBRixFQUFoQjs7TUFHSSxJQUFDLENBQUEsUUFBUSxDQUFDLEVBQVYsQ0FBYSxvQkFBYixFQUFtQyxDQUFBLENBQUEsR0FBQTtlQUFHLElBQUMsQ0FBQSxRQUFRLENBQUMsUUFBVixDQUFtQixhQUFuQjtNQUFILENBQW5DO01BQ0EsSUFBQyxDQUFBLFFBQVEsQ0FBQyxFQUFWLENBQWEsd0JBQWIsRUFBdUMsQ0FBQSxDQUFBLEdBQUE7ZUFBRyxJQUFDLENBQUEsUUFBUSxDQUFDLFdBQVYsQ0FBc0IsYUFBdEI7TUFBSCxDQUF2QztNQUVBLElBQUMsQ0FBQSxRQUFRLENBQUMsRUFBVixDQUFhLFFBQWIsRUFBdUIsSUFBQyxDQUFBLFFBQXhCO0lBUFc7O0lBY2IsUUFBVSxDQUFDLENBQUQsQ0FBQTtBQUNaLFVBQUEsU0FBQSxFQUFBO01BQUksSUFBQyxDQUFBLFFBQVEsQ0FBQyxRQUFWLENBQW1CLFlBQW5CLEVBQUo7OztNQUdJLFNBQUEsR0FBWSxDQUFBLENBQUUsQ0FBQyxDQUFDLE1BQUo7TUFDWixTQUFTLENBQUMsV0FBVixDQUFzQixVQUF0QjtNQUNBLFNBQVMsQ0FBQyxRQUFWLENBQW1CLFdBQW5CLEVBTEo7O01BUUksQ0FBQSxDQUFFLHNDQUFGLENBQXlDLENBQUMsU0FBMUMsQ0FBb0QsSUFBQyxDQUFBLFFBQXJELEVBUko7O01BV0ksS0FBQSxHQUFRLFNBQVMsQ0FBQyxDQUFELENBQUcsQ0FBQzthQUNyQixJQUFDLENBQUEsY0FBRCxDQUFnQixLQUFoQjtJQWJROztJQWVWLGNBQWdCLENBQUMsS0FBRCxDQUFBO0FBQ2xCLFVBQUEsSUFBQSxFQUFBLENBQUEsRUFBQSxHQUFBLEVBQUEsTUFBQSxFQUFBO0FBQUk7TUFBQSxLQUFBLHVDQUFBOztRQUNFLE1BQUEsR0FBUyxJQUFJLFVBQUosQ0FBQTtRQUNULE1BQU0sQ0FBQyxNQUFQLEdBQWdCLENBQUMsQ0FBRCxDQUFBLEdBQUE7QUFDdEIsY0FBQTtVQUFRLEdBQUEsR0FBTSxDQUFDLENBQUMsYUFBYSxDQUFDO2lCQUN0QixJQUFDLENBQUEsUUFBRCxDQUFVLEdBQVYsQ0FBYyxDQUFDLFFBQWYsQ0FBd0IsSUFBQyxDQUFBLFFBQXpCO1FBRmM7cUJBR2hCLE1BQU0sQ0FBQyxhQUFQLENBQXFCLElBQXJCO01BTEYsQ0FBQTs7SUFEYzs7SUFRaEIsUUFBVSxDQUFDLEdBQUQsQ0FBQTthQUNSLENBQUEsQ0FBRSxDQUFBOztjQUFBLENBQUEsQ0FHYyxHQUhkLENBQUE7Ozs7Ozs7TUFBQSxDQUFGO0lBRFE7O0VBdENaOztFQW9EQSxJQUFJLFFBQUosQ0FBQTtBQXJEeUUiLCJzb3VyY2VzQ29udGVudCI6WyIjIFdBUk5JTkc6IFRoaXMgc29sdXRpb24gZG9lc24ndCB3b3JrIG9uIElFLiBJdCB3YXMgdGVzdGVkIG9ubHkgb24gQ2hyb21lXG5jbGFzcyBEcm9wWm9uZVxuICBjb25zdHJ1Y3RvcjogLT5cbiAgICBAZHJvcFpvbmUgPSAkKCcuZHJvcC16b25lJylcblxuICAgICMgQWRkL1JlbW92ZSAuaXMtZHJhZ292ZXIgd2hlbiBob3Zlci9sZWF2ZVxuICAgIEBkcm9wWm9uZS5vbiAnZHJhZ292ZXIgZHJhZ2VudGVyJywgPT4gQGRyb3Bab25lLmFkZENsYXNzKCdpcy1kcmFnb3ZlcicpXG4gICAgQGRyb3Bab25lLm9uICdkcmFnbGVhdmUgZHJhZ2VuZCBkcm9wJywgPT4gQGRyb3Bab25lLnJlbW92ZUNsYXNzKCdpcy1kcmFnb3ZlcicpXG5cbiAgICBAZHJvcFpvbmUub24gJ2NoYW5nZScsIEBvbmNoYW5nZVxuXG4gICAgIyBUT0RPOiAuaGFzLWltYWdlIGhhcyB0byBiZSByZW1vdmVkIHdoZW4gcmVtb3ZlIGFsbCBpbWFnZXNcbiAgICAjIFRPRE86IEdlbmVyYXRlIHVuaXEgaWQgYW5kIGFkZCB0byBpbnB1dC5oYXMtaW1hZ2UgYW5kIC5wcmV2aWV3IFxuICAgICMgICAgICAgaW4gb3JkZXIgdG8gcmVtb3ZlIHRoZW0gYm90aCB3aGVuIGNsaWNrIG9uIC5yZW1vdmVcblxuICAjIEhpZGUgaW5wdXQucmVjZWl2ZXIgYW5kIGluc2VydCB0aGUgbmV3IG9uZVxuICBvbmNoYW5nZTogKGUpID0+XG4gICAgQGRyb3Bab25lLmFkZENsYXNzKCdoYXMtaW1hZ2VzJylcbiAgICBcbiAgICAjIFJlbmFtZSBpbnB1dC5yZWNlaXZlciA9PiBpbnB1dC5oYXMtaW1hZ2VcbiAgICAkcmVjZWl2ZXIgPSAkKGUudGFyZ2V0KVxuICAgICRyZWNlaXZlci5yZW1vdmVDbGFzcygncmVjZWl2ZXInKVxuICAgICRyZWNlaXZlci5hZGRDbGFzcygnaGFzLWltYWdlJylcblxuICAgICMgQWRkIG5ldyAucmVjZWl2ZXJcbiAgICAkKCc8aW5wdXQgdHlwZT1cImZpbGVcIiBjbGFzcz1cInJlY2VpdmVyXCI+JykucHJlcGVuZFRvKEBkcm9wWm9uZSlcblxuICAgICMgUHJldmlld1xuICAgIGZpbGVzID0gJHJlY2VpdmVyWzBdLmZpbGVzXG4gICAgQGRpc3BsYXlQcmV2aWV3KGZpbGVzKVxuXG4gIGRpc3BsYXlQcmV2aWV3OiAoZmlsZXMpIC0+XG4gICAgZm9yIGZpbGUgaW4gZmlsZXNcbiAgICAgIHJlYWRlciA9IG5ldyBGaWxlUmVhZGVyKClcbiAgICAgIHJlYWRlci5vbmxvYWQgPSAoZSkgPT5cbiAgICAgICAgdXJsID0gZS5jdXJyZW50VGFyZ2V0LnJlc3VsdFxuICAgICAgICBAdGVtcGxhdGUodXJsKS5hcHBlbmRUbyhAZHJvcFpvbmUpXG4gICAgICByZWFkZXIucmVhZEFzRGF0YVVSTChmaWxlKVxuXG4gIHRlbXBsYXRlOiAodXJsKSAtPlxuICAgICQgXCJcIlwiXG4gICAgPGRpdiBjbGFzcz1cInByZXZpZXdcIj5cbiAgICAgIDxkaXYgY2xhc3M9XCJpbWFnZVwiPlxuICAgICAgICA8aW1nIHNyYz1cIiN7dXJsfVwiPlxuICAgICAgPC9kaXY+XG4gICAgICA8ZGl2IGNsYXNzPVwiZGV0YWlsc1wiPlxuICAgICAgICA8ZGl2IGNsYXNzPVwicmVtb3ZlXCI+XG4gICAgICAgIDxzcGFuIGNsYXNzPVwiZmEgZmEtdHJhc2hcIj48L3NwYW4+XG4gICAgICAgIDwvZGl2PlxuICAgICAgPC9kaXY+XG4gICAgPC9kaXY+XG4gICAgXCJcIlwiXG5cbm5ldyBEcm9wWm9uZVxuIl19
//# sourceURL=coffeescript