<?php
// data/generate_all_india_states.php - All 28 States & 8 Union Territories
$states = [
    ["code" => "UP", "id" => "uttar-pradesh", "name" => "Uttar Pradesh", "name_hi" => "उत्तर प्रदेश", "capital" => "Lucknow", "ls_seats" => 80, "vs_seats" => 403, "region" => "North"],
    ["code" => "MH", "id" => "maharashtra", "name" => "Maharashtra", "name_hi" => "महाराष्ट्र", "capital" => "Mumbai", "ls_seats" => 48, "vs_seats" => 288, "region" => "West"],
    ["code" => "WB", "id" => "west-bengal", "name" => "West Bengal", "name_hi" => "पश्चिम बंगाल", "capital" => "Kolkata", "ls_seats" => 42, "vs_seats" => 294, "region" => "East"],
    ["code" => "BR", "id" => "bihar", "name" => "Bihar", "name_hi" => "बिहार", "capital" => "Patna", "ls_seats" => 40, "vs_seats" => 243, "region" => "East"],
    ["code" => "TN", "id" => "tamil-nadu", "name" => "Tamil Nadu", "name_hi" => "तमिलनाडु", "capital" => "Chennai", "ls_seats" => 39, "vs_seats" => 234, "region" => "South"],
    ["code" => "MP", "id" => "madhya-pradesh", "name" => "Madhya Pradesh", "name_hi" => "मध्य प्रदेश", "capital" => "Bhopal", "ls_seats" => 29, "vs_seats" => 230, "region" => "Central"],
    ["code" => "KA", "id" => "karnataka", "name" => "Karnataka", "name_hi" => "कर्नाटक", "capital" => "Bengaluru", "ls_seats" => 28, "vs_seats" => 224, "region" => "South"],
    ["code" => "GJ", "id" => "gujarat", "name" => "Gujarat", "name_hi" => "गुजरात", "capital" => "Gandhinagar", "ls_seats" => 26, "vs_seats" => 182, "region" => "West"],
    ["code" => "AP", "id" => "andhra-pradesh", "name" => "Andhra Pradesh", "name_hi" => "आंध्र प्रदेश", "capital" => "Amaravati", "ls_seats" => 25, "vs_seats" => 175, "region" => "South"],
    ["code" => "RJ", "id" => "rajasthan", "name" => "Rajasthan", "name_hi" => "राजस्थान", "capital" => "Jaipur", "ls_seats" => 25, "vs_seats" => 200, "region" => "North"],
    ["code" => "OD", "id" => "odisha", "name" => "Odisha", "name_hi" => "ओडिशा", "capital" => "Bhubaneswar", "ls_seats" => 21, "vs_seats" => 147, "region" => "East"],
    ["code" => "KL", "id" => "kerala", "name" => "Kerala", "name_hi" => "केरल", "capital" => "Thiruvananthapuram", "ls_seats" => 20, "vs_seats" => 140, "region" => "South"],
    ["code" => "TS", "id" => "telangana", "name" => "Telangana", "name_hi" => "तेलंगाना", "capital" => "Hyderabad", "ls_seats" => 17, "vs_seats" => 119, "region" => "South"],
    ["code" => "AS", "id" => "assam", "name" => "Assam", "name_hi" => "असम", "capital" => "Dispur", "ls_seats" => 14, "vs_seats" => 126, "region" => "Northeast"],
    ["code" => "JH", "id" => "jharkhand", "name" => "Jharkhand", "name_hi" => "झारखंड", "capital" => "Ranchi", "ls_seats" => 14, "vs_seats" => 81, "region" => "East"],
    ["code" => "PB", "id" => "punjab", "name" => "Punjab", "name_hi" => "पंजाब", "capital" => "Chandigarh", "ls_seats" => 13, "vs_seats" => 117, "region" => "North"],
    ["code" => "CG", "id" => "chhattisgarh", "name" => "Chhattisgarh", "name_hi" => "छत्तीसगढ़", "capital" => "Raipur", "ls_seats" => 11, "vs_seats" => 90, "region" => "Central"],
    ["code" => "HR", "id" => "haryana", "name" => "Haryana", "name_hi" => "हरियाणा", "capital" => "Chandigarh", "ls_seats" => 10, "vs_seats" => 90, "region" => "North"],
    ["code" => "DL", "id" => "delhi", "name" => "Delhi (NCT)", "name_hi" => "दिल्ली", "capital" => "New Delhi", "ls_seats" => 7, "vs_seats" => 70, "region" => "North"],
    ["code" => "JK", "id" => "jammu-and-kashmir", "name" => "Jammu & Kashmir", "name_hi" => "जम्मू और कश्मीर", "capital" => "Srinagar / Jammu", "ls_seats" => 5, "vs_seats" => 90, "region" => "North"],
    ["code" => "UK", "id" => "uttarakhand", "name" => "Uttarakhand", "name_hi" => "उत्तराखंड", "capital" => "Dehradun", "ls_seats" => 5, "vs_seats" => 70, "region" => "North"],
    ["code" => "HP", "id" => "himachal-pradesh", "name" => "Himachal Pradesh", "name_hi" => "हिमाचल प्रदेश", "capital" => "Shimla", "ls_seats" => 4, "vs_seats" => 68, "region" => "North"],
    ["code" => "TR", "id" => "tripura", "name" => "Tripura", "name_hi" => "त्रिपुरा", "capital" => "Agartala", "ls_seats" => 2, "vs_seats" => 60, "region" => "Northeast"],
    ["code" => "AR", "id" => "arunachal-pradesh", "name" => "Arunachal Pradesh", "name_hi" => "अरुणाचल प्रदेश", "capital" => "Itanagar", "ls_seats" => 2, "vs_seats" => 60, "region" => "Northeast"],
    ["code" => "GA", "id" => "goa", "name" => "Goa", "name_hi" => "गोवा", "capital" => "Panaji", "ls_seats" => 2, "vs_seats" => 40, "region" => "West"],
    ["code" => "MN", "id" => "manipur", "name" => "Manipur", "name_hi" => "मणिपुर", "capital" => "Imphal", "ls_seats" => 2, "vs_seats" => 60, "region" => "Northeast"],
    ["code" => "ML", "id" => "meghalaya", "name" => "Meghalaya", "name_hi" => "मेघालय", "capital" => "Shillong", "ls_seats" => 2, "vs_seats" => 60, "region" => "Northeast"],
    ["code" => "MZ", "id" => "mizoram", "name" => "Mizoram", "name_hi" => "मिजोरम", "capital" => "Aizawl", "ls_seats" => 1, "vs_seats" => 40, "region" => "Northeast"],
    ["code" => "NL", "id" => "nagaland", "name" => "Nagaland", "name_hi" => "नागालैंड", "capital" => "Kohima", "ls_seats" => 1, "vs_seats" => 60, "region" => "Northeast"],
    ["code" => "SK", "id" => "sikkim", "name" => "Sikkim", "name_hi" => "सिक्किम", "capital" => "Gangtok", "ls_seats" => 1, "vs_seats" => 32, "region" => "Northeast"],
    ["code" => "PY", "id" => "puducherry", "name" => "Puducherry", "name_hi" => "पुदुच्चेरी", "capital" => "Puducherry", "ls_seats" => 1, "vs_seats" => 30, "region" => "South"],
    ["code" => "CH", "id" => "chandigarh", "name" => "Chandigarh", "name_hi" => "चंडीगढ़", "capital" => "Chandigarh", "ls_seats" => 1, "vs_seats" => 0, "region" => "North"],
    ["code" => "AN", "id" => "andaman-and-nicobar", "name" => "Andaman & Nicobar", "name_hi" => "अंडमान और निकोबार", "capital" => "Port Blair", "ls_seats" => 1, "vs_seats" => 0, "region" => "UT"],
    ["code" => "DN", "id" => "dadra-and-nagar-haveli", "name" => "Dadra & Nagar Haveli and Daman & Diu", "name_hi" => "दादरा और नगर हवेली", "capital" => "Daman", "ls_seats" => 2, "vs_seats" => 0, "region" => "UT"],
    ["code" => "LA", "id" => "ladakh", "name" => "Ladakh", "name_hi" => "लद्दाख", "capital" => "Leh", "ls_seats" => 1, "vs_seats" => 0, "region" => "North"],
    ["code" => "LD", "id" => "lakshadweep", "name" => "Lakshadweep", "name_hi" => "लक्षद्वीप", "capital" => "Kavaratti", "ls_seats" => 1, "vs_seats" => 0, "region" => "UT"]
];

file_put_contents(__DIR__ . '/states_india.json', json_encode($states, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Generated " . count($states) . " States & UTs in data/states_india.json\n";
