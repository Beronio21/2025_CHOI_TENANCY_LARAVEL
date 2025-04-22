use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordMail;
use App\Mail\ResendPasswordMail;

class TenantController extends Controller
{
    public function resendPasswordEmail($userId)
    {
        // Fetch the user by ID
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Resend the email with the password
        Mail::to($user->email)->send(new ResendPasswordMail($user, $user->password));

        return response()->json(['message' => 'Password email resent successfully']);
    }
} 