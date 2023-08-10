
<?PHP
use Illuminate\Support\Str;

    function generateSlug($text) {
      return  Str::slug($text);
    }

