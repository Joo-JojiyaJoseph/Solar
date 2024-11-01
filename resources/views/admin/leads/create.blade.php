<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="w-full max-w-2xl p-6 m-10 bg-white rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-6 text-center">Lead Entry</h2>

        @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-black rounded">{{ session('success') }}
        </div>
        @endif
        @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

        <form action="{{ route('lead.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="text-center mb-6">
                <label class="block text-gray-600 font-semibold text-sm">Entry Date:</label>
                <input type="text" value="{{ now()->format('d-m-Y') }}"
                    class="text-center text-lg font-bold text-gray-800" readonly>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold">Branch</label>
                <select name="branch"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300 required">
                    <option value="">Select Branch*</option>
                    @foreach ($branchs as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-semibold">Customer Full Name*</label>
                <input type="text" name="customer_name" required
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Customer Address*</label>
                <input type="text" name="customer_address" required
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Landmark</label>
                <input type="text" name="landmark"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Contact Number*</label>
                <input type="tel" name="contact_number" required
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Alternate Number</label>
                <input type="tel" name="alternate_number"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Email ID</label>
                <input type="email" name="email"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Service</label>
                <select name="service"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                    <option>New Solar Buy</option>
                    <option>Maintenance & Service</option>
                    <option>Replacement</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Sub Service</label>
                <select name="sub_service"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300">
                    <option>Not Working</option>
                    <option>Battery Damage</option>
                    <option>Solar Panel Repair</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold">Comments</label>
                <textarea name="comments"
                    class="w-full px-3 py-2 mt-1 border rounded-lg focus:ring-2 focus:ring-blue-400 transition duration-300"></textarea>
            </div>

            <div class="text-center">
                <button type="submit"
                    class="px-6 py-2 bg-green-500 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                    Submit
                </button>
                <a href="{{ route('dashboard', '') }}"><button type="button"
                        class="px-6 py-2 bg-blue-500 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105">
                        Cancel
                    </button></a>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>
</html>

