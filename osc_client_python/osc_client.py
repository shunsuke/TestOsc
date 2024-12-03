from pythonosc import udp_client
from pythonosc import osc_message_builder


def send_osc_message(ip, port, address, *args):
    print("send_osc_message ip: {}, port: {}, address: {}, args: {}".format(ip, port, address, args))

    client = udp_client.SimpleUDPClient(ip, port)
    msg = osc_message_builder.OscMessageBuilder(address=address)
    for arg in args:
        msg.add_arg(arg)
    msg = msg.build()
    client.send(msg)


if __name__ == "__main__":
    ip = 'osc_server'
    port = 9001
    address = "/volume"
    value = 0.75
    send_osc_message(ip, port, address, value)