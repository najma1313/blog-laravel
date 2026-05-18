namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
    // Tampilkan daftar artikel
    public function index() {
        $posts = Post::latest()->get();
        return view('articles.index', compact('posts'));
    }

    // Form tambah artikel
    public function create() {
        return view('articles.create');
    }

    // Simpan ke database
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required'
        ]);
        Post::create($request->all());
        return redirect('/articles')->with('success', 'Artikel berhasil ditambah!');
    }

    // Hapus artikel
    public function destroy(Post $post) {
        $post->delete();
        return redirect('/articles')->with('success', 'Artikel berhasil dihapus!');
    }
}