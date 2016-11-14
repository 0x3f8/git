require 'httparty'

@result = HTTParty.post('http://localhost/sprusage/report.php',
  :body => {
    :test => 'This is a test',
  }.to_json,
  :headers => {
    'Content-Type' => 'application/json',
  }
)

puts @result.parsed_response
