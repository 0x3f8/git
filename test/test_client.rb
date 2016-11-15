require 'httparty'

@result1 = HTTParty.post('http://localhost/sprusage/report.php?type=launch',
  :body => {
    :username => ARGV[0],
    :password => ARGV[1],

    :udid => "0123456789abcdef",
    :appVersion => 2131165227,
    :date => "20161114130421-0500",
    :device => "vbox86p",
    :locale => "USA",
    :lversion => "3.10.0-genymotion-g1d178ae-dirty",
    :manuf => "Genymotion",
    :model => "Samsung Galaxy S4 - 4.4.4 - API 19 - 1080x1920",
    :product => "vbox86p",
    :screenDensityH => 1920,
    :screenDensityW => 1080,
    :sdkint => 19,

  }.to_json,
  :headers => {
    'Content-Type' => 'application/json',
  }
)
puts @result1.parsed_response

@result2 = HTTParty.post('http://localhost/sprusage/report.php?type=usage',
  :body => {
    :username => ARGV[0],
    :password => ARGV[1],

    :udid => "0123456789abcdef",
    :activity => "AddPost",
    :date => "20161114131729-0500",
  }.to_json,
  :headers => {
    'Content-Type' => 'application/json',
  }
)
puts @result2.parsed_response

