require 'httparty'

@result = HTTParty.post('http://localhost/sprusage/report.php',
  :body => {
    :field1 => ARGV[2] || 'value1',
    :field2 => ARGV[3] || 'value2',
    :field3 => ARGV[4] || 'value3',
    :username => ARGV[0],
    :password => ARGV[1],
  }.to_json,
  :headers => {
    'Content-Type' => 'application/json',
  }
)

puts @result.parsed_response
